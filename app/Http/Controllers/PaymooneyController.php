<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\PayRequest;
use Session;
use Illuminate\Support\Facades\Redirect;

class PaymooneyController extends Controller
{
    public function notify(Request $request)
    {
        Log::debug($request);
        $this->extractInfo($request);
    }

    public function success(Request $request)
    {
        Log::debug('success: '.$request);
    }

    function extractInfo($data)
    {
        $extract_refs= Str::of($data['item_ref'])->between('-', '-');
        $first_letter = Str::substr($extract_refs,0,1);
        $id = Str::after($extract_refs,$first_letter);
        Log::debug($extract_refs);
        Log::debug($first_letter);
        Log::debug($id);
        if($first_letter == 'R')
        {
            $this->attachCandidate($data, $id);
        }
        if($first_letter == 'V')
        {
            $this->validatePayment($data,$id);
            if($data['status'] == 'Success')
            {
                $this->paidVote($data,$id);
            }
        }
    }

    function attachCandidate($data, $id)
    {
        $serial = 'SHOSA-S-'.Str::random(7);
        $contest = Contest::where('active',true)->first();
        $totCandidates = $contest->loadCount('candidates')->candidates_count;
        $candidateNumber = $totCandidates + 1;
        $registration = $contest->candidates()->attach($id, ['paid' => $data['status'] == 'Success' ? true : false, 'payment_type' => $data['operator'], 'serial' => $serial, 'candidate_number' => $candidateNumber]);
        Session::flash('message_success', 'Application Succesful'); 
        $this->redirect(route('vote.candidate', $contest->slug));
        Log::debug($registration);
    }


    // implement better
    public function validatePayment($data,$id)
    {
        $p = PayRequest::find($id);
        $p->status =  $data['status'] == 'Success' ? "SUCCESS" : "FAILED";
        $p->pay_service = $data['operator'];
        $p->save();
    }

    public function paidVote($data,$id)
    {
        $paymentRegistered = PayRequest::find($id);
        $cand = Candidate::find($paymentRegistered->candidate_id);
        $contest = Contest::where('active',true)->first();

        $vote = new Vote();
        $vote->contest_id = $contest->id;
        $vote->candidate_id = $cand->id;
        $vote->vote_count = $paymentRegistered->vote_count;
        $vote->ip_address = $_SERVER['REMOTE_ADDR'];
        $vote->payment_type = $data['operator'];
        $vote->payment_status = 'SUCCESS';
        $vote->amount = currency($data['amount'], $from=$data['currency'], $to=$contest->currency, $format=false);
        $vote->currency = $contest->currency;
        $vote->save();

        Log::debug($vote);
        Session::flash('message_success', 'Vote Successful. '.$vote->vote_count.' vote(s) added to '.$cand->name); 
        $this->redirect(route('vote.candidate', $contest->slug));
    }
}
