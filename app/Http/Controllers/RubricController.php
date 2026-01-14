<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rubric;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RubricController extends Controller
{
    public function index()
    {
        $rubrics = Rubric::latest()->get();
        $extras = \App\Models\Extra::latest()->get();
        return view('rubrics.index', compact('rubrics', 'extras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rubric_name' => 'required|string|max:255',
            'rubric_file' => 'required|file|mimes:docx|max:10240', // File Administrasi (wajib)
            'rubric_file_2' => 'required|file|mimes:docx|max:10240', // File Substansi (wajib)
        ]);

        // Create schema first
        $schema = \App\Models\Schema::create([
            'name' => $request->rubric_name,
            'description' => 'Rubrik Penilaian',
            'type' => 'rubric',
            'schema_data' => [
                'created_from' => 'rubric_upload',
                'rubric_name' => $request->rubric_name,
                'file_1_type' => 'administrasi',
                'file_2_type' => 'substansi',
                'timestamp' => now()->toIso8601String(),
            ],
        ]);

        // Save first file (Administrasi) - gunakan nama original
        $originalName1 = $request->file('rubric_file')->getClientOriginalName();
        $path1 = $request->file('rubric_file')->storeAs('rubrics', $originalName1, 'public');

        // Save second file (Substansi) - gunakan nama original
        $originalName2 = $request->file('rubric_file_2')->getClientOriginalName();
        $path2 = $request->file('rubric_file_2')->storeAs('rubrics', $originalName2, 'public');

        // Save to DB
        Rubric::create([
            'rubric_name' => $request->rubric_name,
            'file_path' => $path1,
            'file_path_2' => $path2,
            'schema_id' => $schema->id,
        ]);

        return back()->with('success', 'Rubrik berhasil diupload dan schema telah dibuat.');
    }

    public function destroy($id)
    {
        $rubric = Rubric::findOrFail($id);

        // Delete files from storage
        if ($rubric->file_path && Storage::disk('public')->exists($rubric->file_path)) {
            Storage::disk('public')->delete($rubric->file_path);
        }
        if ($rubric->file_path_2 && Storage::disk('public')->exists($rubric->file_path_2)) {
            Storage::disk('public')->delete($rubric->file_path_2);
        }

        // Delete associated schema if exists
        if ($rubric->schema_id) {
            \App\Models\Schema::where('id', $rubric->schema_id)->delete();
        }

        // Delete rubric record
        $rubric->delete();

        return back()->with('success', 'Rubrik berhasil dihapus.');
    }
}
