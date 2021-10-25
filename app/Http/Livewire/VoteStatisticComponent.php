<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;
use Laravel\Jetstream\ConfirmsPasswords;
use Session;
use Auth;

class VoteStatisticComponent extends Component
{
    use ConfirmsPasswords;

    public Contest $contest;
    public Candidate $candidate;
    public $candidates;
    public $openVote = false;
    public $vote_number,$candi;


    public function render()
    {
        $candidates = $this->contest->candidates;
        $cands = $candidates->transform(function ($cand, $key) {
            $vote_number = $cand->votes()->sum('vote_count');
            $vote_money = $cand->votes()->sum('amount');
            $cand->vote_count = $vote_number;
            $cand->vote_amount = $vote_money;
            return $cand;
        });
        $this->candidates = $cands;
        return view('livewire.vote-statistic-component');
    }

    public function voteManual()
    {
        $this->openVote = true;
    }

    public function addVote()
    {
        $this->openVote = false;
        $this->ensurePasswordIsConfirmed();
        $cand = Candidate::find($this->candi);
        $vote = new Vote();
        $vote->contest_id = $this->contest->id;
        $vote->candidate_id = $cand->id;
        $vote->vote_count = $this->vote_number;
        $vote->ip_address = $_SERVER['REMOTE_ADDR'];
        $vote->payment_type = "Manual Voting";
        $vote->payment_status = Auth::User()->name;
        $vote->save();
        Session::flash('message_success', 'Manual Votes Successful. '.$this->vote_number.' vote(s) added to '.$cand->name); 
        $this->redirect(route('vote.statistics'));
    }
}
