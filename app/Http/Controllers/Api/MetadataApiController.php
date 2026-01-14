<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MetadataApiController extends Controller
{
    /**
     * Import metadata from external system (Web Bima)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        Log::info('Metadata API Import', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'abstract' => 'nullable|string',
            'category' => 'nullable|string',
            'field_of_study' => 'nullable|string',
            'keywords' => 'nullable|string',

            'researcher_id' => 'nullable|string',
            'researcher_name' => 'nullable|string|max:255',
            'study_program' => 'nullable|string',
            'institution' => 'nullable|string',

            'year' => 'nullable|integer',
            'semester' => 'nullable|string',

            'upload_code' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*.filename' => 'required_with:files|string',
            'files.*.file_content' => 'nullable|string', // base64
            'files.*.file_url' => 'nullable|string',

            'output_type' => 'nullable|string',
            'status' => 'nullable|string|in:draft,published,archived',
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

            // Generate upload code if not provided
            $uploadCode = $data['upload_code'] ?? 'META-' . strtoupper(Str::random(8));

            $fileList = [];

            // Process files if provided
            if (isset($data['files']) && is_array($data['files'])) {
                foreach ($data['files'] as $fileData) {
                    if (isset($fileData['file_content'])) {
                        // Handle base64 encoded file
                        $fileContent = base64_decode($fileData['file_content']);
                        $extension = pathinfo($fileData['filename'], PATHINFO_EXTENSION);
                        $filename = Str::uuid() . '.' . $extension;
                        $storagePath = "metadata_files/{$uploadCode}/{$filename}";

                        \Storage::disk('public')->put($storagePath, $fileContent);
                        $fileList[] = $storagePath;
                    } elseif (isset($fileData['file_url'])) {
                        // Store URL reference
                        $fileList[] = $fileData['file_url'];
                    }
                }
            }

            // Create metadata
            $metadata = Metadata::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'abstract' => $data['abstract'] ?? null,
                'category' => $data['category'] ?? null,
                'field_of_study' => $data['field_of_study'] ?? null,
                'keywords' => $data['keywords'] ?? null,

                'researcher_id' => $data['researcher_id'] ?? null,
                'researcher_name' => $data['researcher_name'] ?? null,
                'study_program' => $data['study_program'] ?? null,
                'institution' => $data['institution'] ?? 'Indonesia University of Education',

                'year' => $data['year'] ?? null,
                'semester' => $data['semester'] ?? null,

                'upload_code' => $uploadCode,
                'file_paths' => json_encode($fileList),

                'output_type' => $data['output_type'] ?? null,
                'status' => $data['status'] ?? 'draft',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Metadata imported successfully',
                'data' => [
                    'id' => $metadata->id,
                    'title' => $metadata->title,
                    'upload_code' => $metadata->upload_code,
                    'researcher_name' => $metadata->researcher_name,
                    'year' => $metadata->year,
                    'files_count' => count($fileList),
                    'created_at' => $metadata->created_at,
                ],
            ], 201);
        } catch (\Exception $e) {
            Log::error('Metadata API Import Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to import metadata',
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Get all metadata
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $year = $request->query('year');
        $category = $request->query('category');
        $status = $request->query('status');

        $query = Metadata::query();

        if ($year) {
            $query->where('year', $year);
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $metadata = $query->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $metadata,
        ]);
    }
}
