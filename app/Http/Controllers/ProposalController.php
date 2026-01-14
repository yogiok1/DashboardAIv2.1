<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Proposal;
use App\Models\ProposalGroup;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::latest()->get();

        return view('proposals.index', compact('proposals'));
    }


}
