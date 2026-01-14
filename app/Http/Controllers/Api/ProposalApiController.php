<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProposalApiController extends Controller
{
    /**
     * Accept JSON data for a specific proposal (manual JSON from different endpoint)
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptJson(Request $request, $id)
    {
        try {
            $proposal = Proposal::findOrFail($id);
            
            // Validate incoming JSON data
            $validator = Validator::make($request->all(), [
                'json_data' => 'required|json',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Simpan ke kolom manual_json (bukan json_result)
            $proposal->update([
                'manual_json' => $request->json_data
            ]);
            
            Log::info('Manual JSON accepted for proposal', [
                'proposal_id' => $id,
                'filename' => $proposal->filename,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'JSON berhasil diterima',
                'data' => [
                    'proposal_id' => $proposal->id,
                    'filename' => $proposal->filename,
                    'updated_at' => $proposal->updated_at->toDateTimeString()
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error accepting manual JSON for proposal', [
                'proposal_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get JSON data for a specific proposal
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJson($id)
    {
        try {
            $proposal = Proposal::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'proposal_id' => $proposal->id,
                    'filename' => $proposal->filename,
                    'json_result' => $proposal->json_result,
                    'manual_json' => $proposal->manual_json,
                    'admin_status' => $proposal->admin_status,
                    'ml_result' => $proposal->ml_result,
                    'admin_score' => $proposal->admin_score,
                    'substansi_score' => $proposal->substansi_score,
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Save detailed evaluation JSON for a specific proposal
     * Format: {skema, rubrik: [{nomor, komponen, indikator, sub_item: [...]}]}
     *
     * @param Request $request
     * @param int $proposal_id - ID dari proposal
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveDetailJson(Request $request, $proposal_id)
    {
        try {
            $proposal = Proposal::findOrFail($proposal_id);
            
            // Validate incoming JSON structure
            $validator = Validator::make($request->all(), [
                'skema' => 'required|string',
                'rubrik' => 'required|array',
                'rubrik.*.nomor' => 'required|string',
                'rubrik.*.komponen' => 'required|string',
                'rubrik.*.indikator' => 'required|string',
                'rubrik.*.sub_item' => 'required|array',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Simpan ke kolom manual_json sebagai structured data
            $proposal->update([
                'manual_json' => $request->all()
            ]);
            
            Log::info('Detailed evaluation JSON saved for proposal', [
                'proposal_id' => $proposal_id,
                'filename' => $proposal->filename,
                'skema' => $request->skema,
                'rubrik_count' => count($request->rubrik),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Data evaluasi detail berhasil disimpan',
                'data' => [
                    'proposal_id' => $proposal->id,
                    'filename' => $proposal->filename,
                    'skema' => $request->skema,
                    'rubrik_count' => count($request->rubrik),
                    'updated_at' => $proposal->updated_at->toDateTimeString()
                ]
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal tidak ditemukan'
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Error saving detailed evaluation JSON for proposal', [
                'proposal_id' => $proposal_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
