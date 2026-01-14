<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RubricApiController extends Controller
{
    /**
     * Import rubric from external system (Web Bima)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        Log::info('Rubric API Import', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'rubric_name' => 'required|string|max:255',
            'file_content' => 'nullable|string', // base64 encoded
            'file_url' => 'nullable|string',
            'file_extension' => 'nullable|string|in:pdf,doc,docx,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->all();
            $filePath = null;

            // Handle file upload if base64 content provided
            if (isset($data['file_content'])) {
                $fileContent = base64_decode($data['file_content']);
                $extension = $data['file_extension'] ?? 'pdf';
                $filename = Str::uuid() . '.' . $extension;
                $storagePath = "rubrics/{$filename}";
                
                \Storage::disk('public')->put($storagePath, $fileContent);
                $filePath = $storagePath;
            } elseif (isset($data['file_url'])) {
                $filePath = $data['file_url'];
            }

            // Create rubric
            $rubric = Rubric::create([
                'rubric_name' => $data['rubric_name'],
                'file_path' => $filePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rubric imported successfully',
                'data' => [
                    'id' => $rubric->id,
                    'rubric_name' => $rubric->rubric_name,
                    'file_path' => $rubric->file_path,
                    'created_at' => $rubric->created_at,
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Rubric API Import Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to import rubric',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Get all rubrics
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $rubrics = Rubric::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $rubrics,
        ]);
    }
}
