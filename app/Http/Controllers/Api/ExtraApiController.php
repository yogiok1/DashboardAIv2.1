<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ExtraApiController extends Controller
{
    /**
     * Get all extras
     */
    public function index()
    {
        $extras = Extra::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $extras,
            'total' => $extras->count()
        ]);
    }

    /**
     * Import extra file from external system
     */
    public function import(Request $request)
    {
        Log::info('Extra API Import', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'extra_name' => 'required|string|max:255',
            'file_content' => 'nullable|string', // base64
            'file_url' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $filePath = null;

            if ($request->has('file_content')) {
                // Handle base64 encoded file
                $fileContent = base64_decode($request->file_content);
                $filename = time() . '_' . $request->extra_name . '.docx';
                $storagePath = "extras/{$filename}";

                \Storage::disk('public')->put($storagePath, $fileContent);
                $filePath = $storagePath;
            } elseif ($request->has('file_url')) {
                // Store URL reference
                $filePath = $request->file_url;
            }

            $extra = Extra::create([
                'extra_name' => $request->extra_name,
                'file_path' => $filePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Extra file imported successfully',
                'data' => $extra
            ], 201);

        } catch (\Exception $e) {
            Log::error('Extra API Import Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to import extra file',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
