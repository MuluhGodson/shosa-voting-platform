<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PayRequest;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;
use Auth;
use Session;

class PayentRequestComponent extends Component
{
    public $pr, $contest;
    public function mount()
    {
        $this->pr = PayRequest::orderBy('created_at','desc')->where('status', 'PENDING')->get();
        $this->contest = Contest::where('active',true)->first();
    }
    public function render()
    {
        return view('livewire.payent-request-component');
    }

    public function addVote($id)
    {
        $p = PayRequest::find($id);
        $cand = Candidate::find($p->candidate_id);
        $p->status = "SUCCESS";
        $p->save();
        $vote = new Vote();
        $vote->contest_id = $this->contest->id;
        $vote->candidate_id = $p->candidate_id;
        $vote->vote_count = $p->vote_count;
        $vote->ip_address = $_SERVER['REMOTE_ADDR'];
        $vote->payment_type = "Manual Voting";
        $vote->payment_status = Auth::User()->id;
        $vote->save();
        Session::flash('message_success', 'Manual Votes Successful. '.$p->vote_count.' vote(s) added to '.$cand->name); 
        $this->redirect(route('pay.request'));

    }
}
