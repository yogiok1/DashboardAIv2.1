<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProposalGroup;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DataImportController extends Controller
{
    /**
     * Import data from JSON
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        // Increase execution time for large datasets
        set_time_limit(300); // 5 minutes
        ini_set('memory_limit', '512M');

        // Log raw input for debugging
        Log::info('API Import Request', [
            'raw' => $request->getContent(),
            'all' => $request->all()
        ]);

        // Validasi input
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
            DB::beginTransaction();

            $data = $request->all();

            // Create or update ProposalGroup based on instrument_path
            $groupCode = 'GRP-' . strtoupper($data['instrument_path']) . '-' . time();

            $groupData = [
                'group_name' => $data['scheme'] . ' - ' . $data['instrument_path'],
                'group_code' => $groupCode,
                'scheme' => $data['scheme'],
                'type' => 'current',
                'path' => strtolower($data['instrument_path']), // Instrumen -> instrumen
                'uploaded_at' => now(),
                'status' => 'uploaded',
            ];

            $group = ProposalGroup::create($groupData);

            $proposalsProcessed = [];
            $proposalsFailed = [];
            $proposalsToInsert = [];

            // Process proposals
            foreach ($data['proposals'] as $proposalData) {
                $fileSize = null;

                // Try to get file size if file exists
                if (file_exists(public_path($proposalData['filepath']))) {
                    $fileSize = filesize(public_path($proposalData['filepath']));
                }

                $proposalInfo = [
                    'proposal_group_id' => $group->id,
                    'group_code' => $group->group_code,
                    'filename' => $proposalData['filename'],
                    'path' => $proposalData['filepath'],
                    'size' => $fileSize,
                    'status' => $proposalData['status'] === 'done' ? 'uploaded' : 'failed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $proposalsToInsert[] = $proposalInfo;
            }

            // Bulk insert new proposals
            if (!empty($proposalsToInsert)) {
                Proposal::insert($proposalsToInsert);
                $proposalsProcessed = $proposalsToInsert;
            }

            // Update total files count
            $group->update(['total_files' => count($proposalsProcessed)]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data imported successfully',
                'data' => [
                    'group' => [
                        'id' => $group->id,
                        'code' => $group->group_code,
                        'name' => $group->group_name,
                        'scheme' => $group->scheme,
                        'instrument_path' => $data['instrument_path'],
                    ],
                    'proposals_processed' => count($proposalsProcessed),
                    'proposals_failed' => count($proposalsFailed),
                ],
                'errors' => $proposalsFailed,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to import data',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Get import status
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $type = $request->query('type'); // current or history
        $dataType = $request->query('data_type'); // training, test, sekarang

        $query = ProposalGroup::with(['proposals']);

        if ($type) {
            $query->where('type', $type);
        }

        if ($dataType) {
            $query->where('path', $dataType);
        }

        $groups = $query->get();

        $summary = [
            'total_groups' => $groups->count(),
            'total_proposals' => $groups->sum(fn($g) => $g->proposals->count()),
            'uploaded' => $groups->sum(fn($g) => $g->proposals->where('status', 'uploaded')->count()),
            'failed' => $groups->sum(fn($g) => $g->proposals->where('status', 'failed')->count()),
        ];

        return response()->json([
            'success' => true,
            'summary' => $summary,
            'groups' => $groups,
        ]);
    }
}
