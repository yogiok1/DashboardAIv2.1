<?php

namespace App\Http\Controllers;

use App\Models\AITraining;
use App\Models\ModelAI;
use Illuminate\Http\Request;

class AITrainingController extends Controller
{
    public function index()
    {
        $models = ModelAI::where('is_active', true)->get();
        $trainings = AITraining::with('modelAI')->orderBy('id', 'desc')->get();

        return view('ai-training.index', compact('models', 'trainings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_ai_id' => 'required|exists:model_ais,id',
            'ai_admin_score' => 'nullable|integer',
            'ai_substantive_score' => 'nullable|integer',
            'ai_recommendation' => 'nullable|string',
            'user_review' => 'nullable|string',
            'user_admin_score' => 'nullable|integer',
            'user_substantive_score' => 'nullable|integer',
        ]);

        AITraining::create($request->all());

        return redirect()->back()->with('success', 'AI training data added successfully.');
    }
}
