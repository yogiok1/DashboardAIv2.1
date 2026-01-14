<?php

namespace App\Http\Controllers;

use App\Models\AggregateSetting;
use Illuminate\Http\Request;

class AggregateSettingController extends Controller
{
    public function index()
    {
        $data = AggregateSetting::orderBy('id', 'desc')->get();
        return view('aggregate.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ml_weight' => 'required|integer|min:0|max:100',
            'ai_genera_weight' => 'required|integer|min:0|max:100',
            'status' => 'nullable|boolean'
        ]);

        // jika status aktif, nonaktifkan yang lain
        if ($request->status == 1) {
            AggregateSetting::where('status', 1)->update(['status' => 0]);
        }

        AggregateSetting::create([
            'ml_weight' => $request->ml_weight,
            'ai_genera_weight' => $request->ai_genera_weight,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Pengaturan agregat berhasil disimpan!');
    }
}
