<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MetadataController extends Controller
{
    public function index()
    {
        return view('metadata.index', [
            'metadata' => Metadata::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'nullable|string',
            'year'              => 'nullable|integer',
            'semester'          => 'nullable|string',
            'researcher_name'   => 'nullable|string|max:255',
            'file_paths.*'      => 'nullable|file|max:30720', // max 30MB per file
        ]);

        $uploadCode = 'META-' . strtoupper(Str::random(8));

        // Save uploaded files
        $fileList = [];
        if ($request->hasFile('file_paths')) {
            foreach ($request->file('file_paths') as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("metadata_files/{$uploadCode}", $filename, 'public');
                $fileList[] = $path;
            }
        }

        Metadata::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'abstract'          => $request->abstract,
            'category'          => $request->category,
            'field_of_study'    => $request->field_of_study,
            'keywords'          => $request->keywords,

            'researcher_id'     => $request->researcher_id,
            'researcher_name'   => $request->researcher_name,
            'study_program'     => $request->study_program,
            'institution'       => $request->institution ?? 'Indonesia University of Education',

            'year'              => $request->year,
            'semester'          => $request->semester,

            'upload_code'       => $uploadCode,
            'file_paths'        => json_encode($fileList),   // <<< FIX

            'output_type'       => $request->output_type,
            'status'            => $request->status ?? 'draft',
        ]);

        return back()->with('success', 'Metadata successfully added!');
    }
}
