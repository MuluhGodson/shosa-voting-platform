<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;

class VoteStatisticComponent extends Component
{
    public Contest $contest;
    public Candidate $candidate;
    public $candidates;


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
}
