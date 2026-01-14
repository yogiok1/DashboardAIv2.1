<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProposalGroup;
use App\Models\Proposal;
use App\Models\ProposalGroupResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ModelTestingController extends Controller
{
    /**
     * Direct test - send data directly to AI model without using proposal_group_id
     * This endpoint accepts the exact format that will be sent to AI model
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function directTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instrument_path' => 'required|string',
            'scheme' => 'required|string',
            'proposals' => 'required|array',
            'proposals.*.filename' => 'required|string',
            'proposals.*.filepath' => 'required|string',
            'proposals.*.status' => 'required|string|in:done,failed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get AI Model endpoint from .env
            $aiEndpoint = env('AI_MODEL_ENDPOINT');

            if (!$aiEndpoint) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI Model endpoint not configured',
                    'error' => 'Please set AI_MODEL_ENDPOINT in .env file'
                ], 500);
            }

            $payload = $request->all();

            Log::info('Direct test - Sending data to AI Model', [
                'endpoint' => $aiEndpoint,
                'payload' => $payload
            ]);

            // Send POST request to AI Model endpoint
            $response = Http::timeout(120)
                ->post($aiEndpoint, $payload);

            if ($response->successful()) {
                $responseData = $response->json();

                Log::info('AI Model Response Success', ['response' => $responseData]);

                // TODO: Save to database when proposal_group integration is enabled
                // For now, just return the AI response

                return response()->json([
                    'success' => true,
                    'message' => 'Model test completed successfully',
                    'ai_response' => $responseData,
                ]);
            } else {
                Log::error('AI Model Response Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'AI Model endpoint returned error',
                    'error' => [
                        'status' => $response->status(),
                        'response' => $response->body()
                    ]
                ], $response->status());
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('AI Model Connection Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to AI Model endpoint',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Direct Model Testing Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Model testing failed',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Send proposals data to external AI model endpoint for testing
     * (Using proposal_group_id - commented out for now, use directTest instead)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function runTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proposal_group_id' => 'required|integer|exists:proposal_groups,id',
            'instrument_path' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $groupId = $request->proposal_group_id;
            $group = ProposalGroup::with('proposals')->findOrFail($groupId);

            // Get AI Model endpoint from .env
            $aiEndpoint = env('AI_MODEL_ENDPOINT');

            if (!$aiEndpoint) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI Model endpoint not configured',
                    'error' => 'Please set AI_MODEL_ENDPOINT in .env file'
                ], 500);
            }

            // Prepare data untuk dikirim ke AI model
            $proposalsData = [];
            foreach ($group->proposals as $proposal) {
                $proposalsData[] = [
                    'filename' => $proposal->filename,
                    'filepath' => $proposal->path,
                    'status' => $proposal->status === 'uploaded' ? 'done' : 'failed',
                ];
            }

            $payload = [
                'instrument_path' => $request->instrument_path ?? $group->path,
                'scheme' => $group->scheme,
                'proposals' => $proposalsData,
            ];

            Log::info('Sending data to AI Model', [
                'endpoint' => $aiEndpoint,
                'payload' => $payload
            ]);

            // Send POST request ke AI Model endpoint
            $response = Http::timeout(120) // 2 minutes timeout
                ->post($aiEndpoint, $payload);

            if ($response->successful()) {
                $responseData = $response->json();

                Log::info('AI Model Response Success', ['response' => $responseData]);

                // Save results to database
                DB::beginTransaction();
                try {
                    $result = ProposalGroupResult::updateOrCreate(
                        ['proposal_group_id' => $group->id],
                        [
                            'ai_score' => $responseData['ai_score'] ?? null,
                            'ml_score' => $responseData['ml_score'] ?? null,
                            'ai_notes' => $responseData['ai_notes'] ?? $responseData['notes'] ?? null,
                            'status' => 'completed',
                            'evaluated_at' => now(),
                        ]
                    );

                    // Update individual proposal scores if provided
                    if (isset($responseData['results']) && is_array($responseData['results'])) {
                        foreach ($responseData['results'] as $proposalResult) {
                            $proposal = $group->proposals->firstWhere('filename', $proposalResult['filename']);
                            if ($proposal) {
                                $proposal->update([
                                    'ai_score' => $proposalResult['ai_score'] ?? null,
                                    'ml_score' => $proposalResult['ml_score'] ?? null,
                                    'status' => $proposalResult['status'] ?? 'evaluated',
                                ]);
                            }
                        }
                    }

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Model test completed and results saved successfully',
                        'data' => [
                            'group_id' => $group->id,
                            'group_code' => $group->group_code,
                            'result_id' => $result->id,
                            'ai_score' => $result->ai_score,
                            'ml_score' => $result->ml_score,
                            'status' => $result->status,
                            'ai_response' => $responseData,
                        ]
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Failed to save AI results', ['error' => $e->getMessage()]);

                    return response()->json([
                        'success' => false,
                        'message' => 'AI test completed but failed to save results',
                        'error' => $e->getMessage(),
                        'ai_response' => $responseData
                    ], 500);
                }
            } else {
                Log::error('AI Model Response Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'AI Model endpoint returned error',
                    'error' => [
                        'status' => $response->status(),
                        'response' => $response->body()
                    ]
                ], $response->status());
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('AI Model Connection Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to AI Model endpoint',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            Log::error('Model Testing Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Model testing failed',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Send multiple proposal groups for batch testing
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function runBatchTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_ids' => 'required|array',
            'group_ids.*' => 'integer|exists:proposal_groups,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $results = [];
        $failed = [];

        foreach ($request->group_ids as $groupId) {
            try {
                $testRequest = new Request(['proposal_group_id' => $groupId]);
                $response = $this->runTest($testRequest);

                $results[] = [
                    'group_id' => $groupId,
                    'status' => 'success',
                    'response' => $response->getData()
                ];
            } catch (\Exception $e) {
                $failed[] = [
                    'group_id' => $groupId,
                    'error' => $e->getMessage()
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Batch testing completed',
            'results' => $results,
            'failed' => $failed,
            'summary' => [
                'total' => count($request->group_ids),
                'success' => count($results),
                'failed' => count($failed)
            ]
        ]);
    }
}
