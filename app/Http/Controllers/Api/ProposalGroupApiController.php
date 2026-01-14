<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProposalGroup;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProposalGroupApiController extends Controller
{
    /**
     * Import proposal group from external system (Web Bima)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        Log::info('Proposal Group API Import', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'scheme' => 'required|string',
            'type' => 'required|string|in:current,history',
            'path' => 'nullable|string|in:training,test,sekarang',
            'group_code' => 'nullable|string',
            'group_name' => 'nullable|string',
            'proposals' => 'required|array',
            'proposals.*.filename' => 'required|string',
            'proposals.*.file_content' => 'nullable|string', // base64 encoded
            'proposals.*.file_url' => 'nullable|string',
            'proposals.*.size' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = $request->all();

            // Generate group code if not provided
            $groupCode = $data['group_code'] ?? null;

            if (!$groupCode) {
                $lastGroup = ProposalGroup::orderBy('id', 'desc')->first();
                $nextNumber = $lastGroup ? $lastGroup->id + 1 : 1;
                $sequence = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

                $groupCode = strtolower($data['type'])
                    . '_' . strtoupper($data['scheme'])
                    . '_' . now()->format('Y_m_d')
                    . '_' . $sequence;
            }

            $groupName = $data['group_name'] ?? $groupCode;

            // Check if group exists
            $group = ProposalGroup::where('group_code', $groupCode)->first();

            if ($group) {
                // Update existing group
                $group->update([
                    'group_name' => $groupName,
                    'scheme' => $data['scheme'],
                    'type' => $data['type'],
                    'path' => $data['path'] ?? 'sekarang',
                    'total_files' => count($data['proposals']),
                    'status' => 'uploaded',
                ]);
            } else {
                // Create new group
                $group = ProposalGroup::create([
                    'group_code' => $groupCode,
                    'group_name' => $groupName,
                    'scheme' => $data['scheme'],
                    'type' => $data['type'],
                    'path' => $data['path'] ?? 'sekarang',
                    'total_files' => count($data['proposals']),
                    'uploaded_at' => now(),
                    'status' => 'uploaded',
                ]);
            }

            $proposalsProcessed = [];
            $proposalsFailed = [];

            // Process proposals
            foreach ($data['proposals'] as $proposalData) {
                try {
                    $filePath = null;

                    // Handle file upload if base64 content provided
                    if (isset($proposalData['file_content'])) {
                        $fileContent = base64_decode($proposalData['file_content']);
                        $filename = time() . '_' . $proposalData['filename'];
                        $storagePath = "proposals/{$groupCode}/{$filename}";

                        Storage::disk('public')->put($storagePath, $fileContent);
                        $filePath = $storagePath;
                    } elseif (isset($proposalData['file_url'])) {
                        $filePath = $proposalData['file_url'];
                    }

                    $proposal = Proposal::create([
                        'proposal_group_id' => $group->id,
                        'group_code' => $groupCode,
                        'filename' => $proposalData['filename'],
                        'path' => $filePath,
                        'size' => $proposalData['size'] ?? null,
                        'status' => 'uploaded',
                    ]);

                    $proposalsProcessed[] = [
                        'id' => $proposal->id,
                        'filename' => $proposal->filename,
                    ];
                } catch (\Exception $e) {
                    $proposalsFailed[] = [
                        'filename' => $proposalData['filename'],
                        'error' => $e->getMessage(),
                    ];
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Proposal group imported successfully',
                'data' => [
                    'group' => [
                        'id' => $group->id,
                        'code' => $group->group_code,
                        'name' => $group->group_name,
                        'scheme' => $group->scheme,
                        'type' => $group->type,
                        'path' => $group->path,
                    ],
                    'proposals_processed' => count($proposalsProcessed),
                    'proposals_failed' => count($proposalsFailed),
                    'proposals' => $proposalsProcessed,
                ],
                'errors' => $proposalsFailed,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Proposal Group API Import Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to import proposal group',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Get proposal groups
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
        $scheme = $request->query('scheme');

        $query = ProposalGroup::with(['proposals']);

        if ($type) {
            $query->where('type', $type);
        }

        if ($scheme) {
            $query->where('scheme', $scheme);
        }

        $groups = $query->orderBy('uploaded_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $groups,
        ]);
    }

    /**
     * Get proposals for a specific group
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProposals($id)
    {
        try {
            $group = ProposalGroup::findOrFail($id);
            $proposals = Proposal::where('proposal_group_id', $id)
                ->orderBy('id', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'group' => [
                    'id' => $group->id,
                    'group_name' => $group->group_name,
                    'scheme' => $group->scheme,
                    'uploaded_at' => $group->uploaded_at,
                ],
                'proposals' => $proposals->map(function($p) {
                    return [
                        'id' => $p->id,
                        'filename' => $p->filename,
                        'path' => $p->path,
                        'status' => $p->status ?? 'pending',
                        'size' => $p->size,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load proposals',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Get status of a specific group
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus($id)
    {
        try {
            $group = ProposalGroup::findOrFail($id);
            $proposals = Proposal::where('proposal_group_id', $id)->get();
            
            $totalProposals = $proposals->count();
            
            // Count evaluated proposals
            $evaluatedProposals = $proposals->filter(function($p) {
                return $p->evaluation_id !== null && 
                       $p->json_result !== null && 
                       ($p->admin_score !== null || $p->substansi_score !== null);
            });
            
            $evaluatedCount = $evaluatedProposals->count();
            
            // Count results
            $lolosCount = $evaluatedProposals->filter(function($p) {
                $mlResult = strtolower($p->ml_result ?? '');
                return str_contains($mlResult, 'lolos') && !str_contains($mlResult, 'tidak');
            })->count();
            
            $tidakLolosCount = $evaluatedProposals->filter(function($p) {
                $mlResult = strtolower($p->ml_result ?? '');
                return str_contains($mlResult, 'tidak') && str_contains($mlResult, 'lolos');
            })->count();
            
            $completionRate = $totalProposals > 0 ? ($evaluatedCount / $totalProposals) * 100 : 0;
            
            return response()->json([
                'success' => true,
                'group' => [
                    'id' => $group->id,
                    'group_name' => $group->group_name,
                    'group_code' => $group->group_code,
                    'scheme' => $group->scheme,
                    'assessment_type' => $group->assessment_type,
                    'uploaded_at' => $group->uploaded_at,
                    'status' => $group->status,
                ],
                'total_proposals' => $totalProposals,
                'evaluated_count' => $evaluatedCount,
                'pending_count' => $totalProposals - $evaluatedCount,
                'lolos_count' => $lolosCount,
                'tidak_lolos_count' => $tidakLolosCount,
                'completion_rate' => round($completionRate, 2),
                'timestamp' => now()->toIso8601String(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get group status',
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
