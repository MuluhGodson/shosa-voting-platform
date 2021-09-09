<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Candidate;

class VoteController extends Controller
{
    public function index()
    {
        $contest = Contest::where('active',true)->first();
        if(!$contest) return view('user.vote.index'); 
        return view('user.vote.show', compact('contest'));
        //  
    }

    public function show(Contest $contest)
    {
        return view('user.vote.show', compact('contest'));
    }

    public function statistics()
    {
        $contest = Contest::where('active',true)->first();
        if(!$contest) return redirect(route('dashboard'));
        return view('admin.contest.statistics', compact('contest')); 
    }
}
