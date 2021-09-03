<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use Illuminate\Support\Str;



class VoteComponent extends Component
{
    public Contest $contest;
    public $viewContest, $showText = false;
    public $text_words = 15;
    public $active = true;
    public $fee = true;
    public $tarrif = true;
    public $name, $description, $amount, $b_date, $e_date, $cover, $contests, $currency, $currencies, $vote_fee, $event_photo, $slug;


    public function render()
    {
        $this->contests = Contest::where('active',true)->where('ending_date', '>=', today()->toDateString())->get();
        return view('livewire.vote-component');
    }

    public function openView(Contest $contest)
    {
        $this->name = $contest->name;
        $this->slug = $contest->slug;
        $this->fee = $contest->fee;
        $this->active = $contest->active;
        $this->currency = $contest->currency;
        $this->amount = currency_format((float)$contest->fee_amount, $contest->currency);
        $this->tarrif = $contest->vote_tarrif;
        $this->vote_count = $contest->vote_count;
        $this->vote_fee = currency_format((float)$contest->vote_fee,$contest->currency); 
        $this->description = $contest->description;
        $this->b_date = $contest->beginning_date;
        $this->e_date = $contest->ending_date;
        $this->event_photo = $contest->cover_image;
        
        $this->viewContest = true;
    }

    public function openText(Contest $contest,$type)
    {
        $this->description = $contest->description;
        $this->slug = $contest->slug;
        if($type == 'y')
        {
            $this->showText = true;
            $this->text_words = Str::wordCount($this->description);
            
        }
        else {
            $this->showText = false;
            $this->text_words = 50;
            
        }
    }

    
}
