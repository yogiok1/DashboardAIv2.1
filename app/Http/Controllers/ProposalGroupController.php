<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalGroup;
use App\Models\Rubric;
use Illuminate\Http\Request;

class ProposalGroupController extends Controller
{
    public function index()
    {
        $groups = ProposalGroup::orderBy('uploaded_at', 'desc')->get();
        $rubrics = Rubric::all();

        return view('proposal-groups.index', compact('groups', 'rubrics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scheme' => 'required|string',
            'type' => 'required|in:current,history',
            'files.*' => 'required|file|mimes:pdf'
        ]);

        $files = $request->file('files');
        $total = count($files);

        // Get last sequence number
        $lastGroup = ProposalGroup::orderBy('id', 'desc')->first();
        $nextNumber = $lastGroup ? $lastGroup->id + 1 : 1;
        $sequence = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Build generated group name
        $generatedName = strtolower($request->type)
            . '_' . strtoupper($request->scheme)
            . '_' . now()->format('Y_m_d')
            . '_' . $sequence;

        // Create group
        $group = ProposalGroup::create([
            'group_code' => $generatedName,
            'group_name' => $generatedName,
            'scheme' => $request->scheme,
            'type' => $request->type,
            'total_files' => $total,
            'uploaded_at' => now(),
            'status' => 'uploaded',
        ]);

        // Save files normally...
        foreach ($files as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs("proposals/{$generatedName}", $filename, 'public');

            Proposal::create([
                'proposal_group_id' => $group->id,
                'group_code' => $generatedName,
                'filename' => $filename,
                'path' => $path,
                'size' => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Proposal group uploaded successfully!');
    }

    public function show(ProposalGroup $group)
    {
        $proposals = Proposal::where('group_code', $group->group_code)->get();

        return view('proposal-groups.group-detail', compact('group', 'proposals'));
    }
}
