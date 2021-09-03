<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function index(Contest $contest)
    {
        return view('admin.candidate.index', compact('contest'));
    }
}
