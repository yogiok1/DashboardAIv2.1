<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtraController extends Controller
{
    public function index()
    {
        return view('extras.index', [
            'extras' => Extra::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'extra_name' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:docx|max:10240', // 10MB, only DOCX
        ]);

        // Save file
        $file = $request->file('file_path');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('extras', $filename, 'public');

        Extra::create([
            'extra_name' => $validated['extra_name'],
            'file_path' => $path,
        ]);

        return back()->with('success', 'Template berhasil diunggah!');
    }

    public function destroy(Extra $extra)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($extra->file_path)) {
            Storage::disk('public')->delete($extra->file_path);
        }

        $extra->delete();

        return back()->with('success', 'Template berhasil dihapus!');
    }
}
