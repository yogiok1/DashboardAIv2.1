<?php

namespace App\Http\Controllers;

use App\Models\ExternalSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExternalSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = ExternalSource::latest()->get();
        return view('external-sources.index', compact('sources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file_path' => 'required|file|mimes:pdf|max:51200', // 50MB
        ]);

        $file = $request->file('file_path');
        $filename = $file->getClientOriginalName();
        
        // Store file in external-sources directory
        $path = $file->storeAs('external-sources', $filename, 'public');
        
        // Auto-generate source name from filename (without extension)
        $sourceName = pathinfo($filename, PATHINFO_FILENAME);
        
        ExternalSource::create([
            'source_name' => $sourceName,
            'file_path' => $path,
            'original_filename' => $filename,
            'file_size' => $file->getSize(),
            'type' => 'book',
        ]);

        return redirect()->route('external-sources.index')
            ->with('success', 'Buku berhasil diunggah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $source = ExternalSource::findOrFail($id);
        
        // Delete file from storage
        if (Storage::disk('public')->exists($source->file_path)) {
            Storage::disk('public')->delete($source->file_path);
        }
        
        $source->delete();

        return redirect()->route('external-sources.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}

