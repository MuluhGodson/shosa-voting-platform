<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Candidate;

class VoteController extends Controller
{
    public function index()
    {
        return view('user.vote.index');   
    }

    public function show(Contest $contest)
    {
        return view('user.vote.show', compact('contest'));
    }
}
