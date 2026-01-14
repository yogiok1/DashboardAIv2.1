<?php

namespace App\Http\Controllers;

use App\Models\ModelAI;
use Illuminate\Http\Request;

class ModelAIController extends Controller
{
    public function index()
    {
        $models = ModelAI::latest()->get();
        return view('modelai.index', compact('models'));
    }

    public function create()
    {
        return view('modelai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'provider'   => 'required|string|max:50',
            'model_code' => 'required|string|max:100|unique:model_ais',
            'description'=> 'nullable|string',
        ]);

        ModelAI::create($request->all());

        return redirect()->route('modelai.index')->with('success', 'Model AI berhasil ditambahkan.');
    }
}
