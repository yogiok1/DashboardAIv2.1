<?php

namespace App\Http\Controllers;

use App\Models\ProposalGroup;
use App\Models\ProposalGroupResult;
use Illuminate\Http\Request;

class ProposalGroupResultController extends Controller
{
    public function index(Request $request)
    {
        // Get filter dari request (default: semua)
        $filter = $request->get('filter', 'all');
        
        // Build query based on filter - urutkan dari terbaru
        $query = ProposalGroup::with(['proposals'])->latest();
        
        if ($filter !== 'all' && in_array($filter, ['administrasi', 'substansi', 'gabungan_naive', 'gabungan_selected'])) {
            $query->where('assessment_type', $filter);
        }
        
        $groups = $query->get();
        
        // Count by assessment_type untuk cards
        $counts = [
            'administrasi' => ProposalGroup::where('assessment_type', 'administrasi')->count(),
            'substansi' => ProposalGroup::where('assessment_type', 'substansi')->count(),
            'gabungan_naive' => ProposalGroup::where('assessment_type', 'gabungan_naive')->count(),
            'all_process_selected' => ProposalGroup::where('assessment_type', 'gabungan_selected')->count(),
        ];

        return view('results.index', compact('groups', 'filter', 'counts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proposal_group_id' => 'required|exists:proposal_groups,id',
            'accepted' => 'required|integer|min:0',
            'rejected' => 'required|integer|min:0',
            'others' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        ProposalGroupResult::create($request->all());

        return redirect()->back()->with('success', 'Result berhasil disimpan.');
    }

    public function detail($id)
    {
        $group = ProposalGroup::with('proposals')->findOrFail($id);

        return view('results.detail', compact('group'));
    }
}
