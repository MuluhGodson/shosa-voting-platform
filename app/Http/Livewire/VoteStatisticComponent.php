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


    public function render()
    {
        return view('livewire.vote-statistic-component');
    }
}
