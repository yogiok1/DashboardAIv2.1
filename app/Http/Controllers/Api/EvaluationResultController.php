<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalGroup;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluationResultController extends Controller
{
    /**
     * Store evaluation result from external AI/ML service
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Log incoming request
            Log::info('Evaluation Result Received', [
                'proposal_id' => $request->input('proposal_id'),
                'evaluation_id' => $request->input('id'),
                'has_administrasi' => $request->has('details.administrasi'),
                'has_substansi' => $request->has('details.substansi'),
            ]);

            // Validasi request
            $validated = $request->validate([
                'id' => 'required|string',
                'user' => 'required|string',
                'proposal_id' => 'required|integer',
                'proposal_group' => 'required|integer',
                'start_time' => 'required|string',
                'status' => 'required|integer',
                'processing_time' => 'nullable|string',
                'file_info' => 'required|array',
                'file_info.proposal' => 'required|string',
                'file_info.detected_scheme_code' => 'nullable|string',
                'file_info.year' => 'required|integer',
                'final_result' => 'nullable|array',
                'final_result.final_recommendation' => 'nullable|string',
                'final_result.summary' => 'nullable|string',
                'ml_result' => 'nullable|string',
                'details' => 'required|array',
            ]);

            DB::beginTransaction();

            // 1. Cari proposal berdasarkan ID dari request
            $proposal = Proposal::findOrFail($validated['proposal_id']);
            $proposalGroup = ProposalGroup::findOrFail($validated['proposal_group']);

            // 2. Hitung score dari details
            $administrasiData = $validated['details']['administrasi'] ?? null;
            $substansiData = $validated['details']['substansi'] ?? null;
            
            $administrasiScore = null;
            $administrasiStatus = null;
            $substansiScore = null;
            
            if ($administrasiData && is_array($administrasiData)) {
                $administrasiScore = $administrasiData['total_score'] ?? null;
                $administrasiStatus = $administrasiData['status'] ?? null;
            }
            
            if ($substansiData && is_array($substansiData)) {
                $substansiScore = $substansiData['total_weighted_score'] ?? null;
            }
            
            // Normalize ml_result
            $mlResult = $validated['ml_result'] ?? null;
            if ($mlResult) {
                $mlResultLower = strtolower($mlResult);
                if (str_contains($mlResultLower, 'tidak') && str_contains($mlResultLower, 'lolos')) {
                    $mlResult = 'TIDAK LOLOS';
                } elseif (str_contains($mlResultLower, 'lolos')) {
                    $mlResult = 'LOLOS';
                }
            }

            // 3. Update proposal dengan hasil Penilaian
            $finalRecommendation = null;
            $finalSummary = null;
            
            if (isset($validated['final_result']) && is_array($validated['final_result'])) {
                $finalRecommendation = $validated['final_result']['final_recommendation'] ?? null;
                $finalSummary = $validated['final_result']['summary'] ?? null;
            }
            
            $proposal->evaluation_status = $finalRecommendation ? $this->mapEvaluationStatus($finalRecommendation) : 'dinilai';
            $proposal->ml_result = $mlResult;
            $proposal->ai_notes = $finalSummary ?? '';
            $proposal->status = 'evaluated';
            $proposal->json_result = json_encode($validated);

            // Detail Penilaian
            $proposal->evaluation_id = $validated['id'] ?? null;
            $proposal->evaluator_username = $validated['user'] ?? null;
            $proposal->evaluation_start_time = isset($validated['start_time']) ? \Carbon\Carbon::parse($validated['start_time']) : null;
            $proposal->processing_time = $validated['processing_time'] ?? null;

            // Administration evaluation
            $proposal->admin_score = $administrasiScore;
            $proposal->admin_status = $administrasiStatus;

            // Substansi evaluation details
            $proposal->substansi_score = $substansiScore;
            if ($substansiData && is_array($substansiData)) {
                $proposal->substansi_max_score = $substansiData['max_item_score'] ?? null;
                $proposal->substansi_min_score = $substansiData['min_item_score'] ?? null;
                $proposal->substansi_summary = $substansiData['summary'] ?? null;
            }

            // Set ai_score (prioritas substansi, fallback administrasi)
            $proposal->ai_score = $substansiScore ?? $administrasiScore;

            // 4. Update assessment_status berdasarkan data yang diterima
            $hasAdministrasi = $administrasiData && is_array($administrasiData);
            $hasSubstansi = $substansiData && is_array($substansiData) && !is_null($substansiScore);
            
            if ($hasAdministrasi && $hasSubstansi) {
                $proposal->assessment_status = 3; // Sudah keduanya
            } elseif ($hasAdministrasi && !$hasSubstansi) {
                $proposal->assessment_status = 1; // Sudah administrasi saja
            } elseif (!$hasAdministrasi && $hasSubstansi) {
                $proposal->assessment_status = 2; // Sudah substansi saja
            }

            $proposal->save();

            DB::commit();

            Log::info('Evaluation Result Stored Successfully', [
                'proposal_id' => $proposal->id,
                'evaluation_id' => $proposal->evaluation_id,
                'assessment_status' => $proposal->assessment_status,
                'admin_score' => $proposal->admin_score,
                'substansi_score' => $proposal->substansi_score,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Evaluation result stored successfully',
                'data' => [
                    'proposal_id' => $proposal->id,
                    'proposal_group_id' => $proposalGroup->id,
                    'evaluation_id' => $proposal->evaluation_id,
                    'filename' => $proposal->filename,
                    'evaluation_status' => $proposal->evaluation_status,
                    'assessment_status' => $proposal->assessment_status,
                    'ai_score' => $proposal->ai_score,
                    'ml_result' => $proposal->ml_result,
                    'admin_score' => $proposal->admin_score,
                    'admin_status' => $proposal->admin_status,
                    'substansi_score' => $proposal->substansi_score,
                    'processing_time' => $proposal->processing_time,
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation Error in Evaluation Result', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing evaluation result', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error storing evaluation result',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Map recommendation text to evaluation status
     */
    private function mapEvaluationStatus($recommendation)
    {
        $recommendation = strtolower($recommendation);

        if (str_contains($recommendation, 'diterima') || str_contains($recommendation, 'lolos')) {
            return 'lolos';
        } elseif (str_contains($recommendation, 'ditolak') || str_contains($recommendation, 'tidak lolos')) {
            return 'tidak_lolos';
        }

        return 'dinilai';
    }

    /**
     * Extract ML score from ML result text
     */
    private function extractMLScore($mlResult)
    {
        if (!$mlResult) {
            return null;
        }

        // Jika ML result adalah "Tidak Lolos" bisa di-map ke score tertentu
        if (strtolower($mlResult) === 'tidak lolos') {
            return 0.0;
        } elseif (strtolower($mlResult) === 'lolos') {
            return 100.0;
        }

        // Jika ada angka di string, extract
        if (preg_match('/(\d+\.?\d*)/', $mlResult, $matches)) {
            return (float) $matches[1];
        }

        return null;
    }

    /**
     * Test endpoint - send JSON to external AI service
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function test(Request $request)
    {
        try {
            // Validasi request - hanya terima parameter minimal dari frontend
            $validated = $request->validate([
                'proposal_group' => 'required|integer',
                'rubric_id' => 'required|integer',
                'extra_id' => 'nullable|string',
                'assessment_type' => 'required|string|in:administrasi,substansi,gabungan_naive,gabungan_selected',
            ]);

            // Ambil data dari database
            $group = ProposalGroup::findOrFail($validated['proposal_group']);
            $rubric = \App\Models\Rubric::findOrFail($validated['rubric_id']);
            $proposals = Proposal::where('proposal_group_id', $group->id)->get();
            
            // Update assessment_type di proposal_group
            $group->assessment_type = $validated['assessment_type'];
            $group->save();

            if ($proposals->isEmpty()) {
                throw new \Exception('No proposals found in this group');
            }

            // Build payload lengkap di controller
            $baseUrl = env('APP_URL', 'http://72.61.215.182');

            // Build instrument object dengan administrasi dan substansi
            $instrument = [];
            if ($rubric->file_path) {
                $instrument['administrasi'] = $baseUrl . '/storage/' . $rubric->file_path;
            }
            if ($rubric->file_path_2) {
                $instrument['substansi'] = $baseUrl . '/storage/' . $rubric->file_path_2;
            }
            
            // Get extra path if selected
            $extraPath = "-"; // Default jika tidak dipilih atau pilih '-'
            if (isset($validated['extra_id']) && $validated['extra_id'] !== '-') {
                $extra = \App\Models\Extra::find($validated['extra_id']);
                if ($extra) {
                    $extraPath = $baseUrl . '/storage/' . $extra->file_path;
                }
            }

            // Get assessment_type
            $assessmentType = $validated['assessment_type'];

            $payload = [
                'username' => \Auth::check() ? \Auth::user()->name : 'guest',
                'scheme' => $rubric->rubric_name, // Nama rubric sebagai scheme
                'year' => $group->uploaded_at ? (int) $group->uploaded_at->format('Y') : (int) date('Y'),
                'assessment_type' => $assessmentType,
                'ml_sub' => true, // Hardcoded default value
                'instrument' => $instrument,
                'extra_path' => $extraPath,
                'proposal_group' => $group->id,
                'proposals' => $proposals->map(function ($p) use ($baseUrl) {
                    return [
                        'id_proposal' => $p->id,
                        'filename' => $p->filename,
                        'filepath' => $baseUrl . '/storage/' . $p->path,
                        'status' => $p->assessment_status ?? 0, // Kirim assessment_status sebagai integer
                    ];
                })->values()->all()
            ];

            // Log payload yang akan dikirim
            Log::info('Evaluation test request received', [
                'assessment_type' => $assessmentType,
                'payload' => $payload,
                'proposal_count' => count($payload['proposals']),
            ]);

            // Ambil AI endpoint dari env
            $aiEndpoint = env('AI_MODEL_ENDPOINT');

            if (!$aiEndpoint) {
                throw new \Exception('AI_MODEL_ENDPOINT not configured in .env');
            }

            Log::info('Sending to AI endpoint', ['endpoint' => $aiEndpoint]);

            // Kirim ke AI service
            $response = \Illuminate\Support\Facades\Http::timeout(30)
                ->post($aiEndpoint, $payload);

            if ($response->successful()) {
                Log::info('AI service response received', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Request sent to AI service successfully',
                    'sent_payload' => $payload,
                    'ai_response' => $response->json(),
                    'ai_endpoint' => $aiEndpoint,
                    'timestamp' => now()->format('Y-m-d H:i:s'),
                ], 200);
            } else {
                Log::error('AI service error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'AI service returned error',
                    'sent_payload' => $payload,
                    'error' => $response->body(),
                    'status_code' => $response->status(),
                ], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in evaluation test: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing evaluation test',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
