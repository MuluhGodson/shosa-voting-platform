<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Utils\Currency;
use Illuminate\Support\Str;
use Malico\MeSomb\Payment;
use Malico\MobileCM\Network;
use Session;

class ContestantVoteComponent extends Component
{
    public Contest $contest;
    public Candidate $candidate;
    public $candidates;
    public $viewCandidate, $showText = false;
    public $text_words = 15;
    public $vote_payment, $isLocal, $isIntl, $payStatus, $voted_already, $vote_succesful = false;
    public $data, $refs, $slug, $p_type, $free_vote, $flutter_data, $pub, $fee, $momo_tel, $name, $tel, $email, $currencies, $vote_fee, $currency, $vote_count, $vote_amount, $currency_symbol;

    protected $listeners = ['flutterTrans', 'flutterClose'];


    public function mount()
    {
        $this->currencies = Currency::all();
        $this->currency = $this->contest->currency;
        $this->refs = 'SHOSAVOTE-'.Str::random(20);
        $this->pub = config('flutterwave.public');
    }

    public function render()
    {
        return view('livewire.contestant-vote-component');
    }

    public function openCandidate(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->viewCandidate = true;
    }


    public function openText(Candidate $candidate,$type)
    {
        $this->bio = $candidate->bio;
        if($type == 'y')
        {
            $this->showText = true;
            $this->text_words = Str::wordCount($this->bio);
            
        }
        else {
            $this->showText = false;
            $this->text_words = 50;
            
        }
    }

    public function openVote(Candidate $candidate)
    {
        $this->slug = $candidate->slug;
        $this->candidate = $candidate;
        $this->viewCandidate = false;
        if($this->contest->vote_tarrif)
        {
            $this->vote_fee = (int)$this->contest->vote_fee;
            $this->vote_count = $this->contest->vote_count;
            $this->vote_amount = (int)$this->contest->vote_fee;
            $this->currency = $this->contest->currency;
            $this->currency_symbol = currency_format($this->vote_fee, $code = $this->currency);
            $this->vote_payment = true;
            

        } else {
            $this->free_vote = true;
        }
        
    }

    public function updatedCurrency()
    {

        if($this->vote_amount == null)
        {
            $this->vote_amount = '';
        } else{
            $vm = (int)currency(preg_replace('/,/', '',$this->vote_amount), $from = $this->currency, $to = $this->contest->currency, $format = false);
            $vc = ($vm / (int)$this->contest->vote_fee) * (int)$this->contest->vote_count;
            $this->vote_count = (int)$vc;
            $this->vote_fee = $this->vote_amount;
            $this->currency_symbol = currency_format($this->vote_amount, $code = $this->currency);
            //dd($this->currency_symbol);
        }
        
    }

    public function updatedVoteAmount()
    {
        if($this->vote_amount == null)
        {
            $this->vote_amount = '';
        } else{
            $vm = (int)currency(preg_replace('/,/', '',$this->vote_amount), $from = $this->currency, $to = $this->contest->currency, $format = false);
            $vc = ($vm / (int)$this->contest->vote_fee) * (int)$this->contest->vote_count;
            $this->vote_count = (int)$vc;
            $this->vote_fee = $this->vote_amount;
            $this->currency_symbol = currency_format($this->vote_amount, $code = $this->currency);
            //dd($this->currency_symbol);
        }
        
    }

    public function callFlutter()
    {
        $this->vote_amount = preg_replace('/,/', '',$this->vote_amount);
        $this->validate(['name' => 'required', 'vote_amount' => 'required|numeric', 'email' => 'required', 'currency' => 'required']);

        //Initialize new variables for Flutter JS
    	$this->dispatchBrowserEvent('flutterpay', ['nm' => $this->name, 'cr' => $this->currency, 'am' => $this->vote_amount, 'em'=>$this->email, 'des' => $this->contest->name, 'refs' => $this->refs, 'pub' => $this->pub]);
    }

    public function flutterTrans($data)
    {
        $this->flutter_data = $data;
        if ($data['status'] == 'successful') {
            $this->payStatus = true;
            $this->paidVote($this->slug, 'FLUTTER');
        } else {
            Session::flash('message', 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN'); 
            $this->redirect->route('vote.candidate',$this->contest->slug);
        }
    }

    public function flutterClose()
    {
        if($this->flutter_data){
            if ($this->flutter_data['status'] == 'successful') {
                Session::flash('message_success', 'Vote Successful. '.$this->vote_count.' vote(s) added to '.$this->contestant->name); 
                $this->redirect->route('vote.candidate',  $this->contest->slug);
            }
        }
        else {
            Session::flash('message', 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN'); 
            $this->redirect(route('vote.candidate', $this->contest->slug));
        }
    }

    public function getPaymentType($t)
    {
        $this->dispatchBrowserEvent('tel-number');
        $this->p_type = $t;
        if ($t == 1) {
            $this->momo_tel = $this->tel;
            $this->isLocal = true;
            $this->isIntl = false;
        } elseif ($t == 2) {
             $this->isLocal = false;
             $this->isIntl = true;
        } else {
            abort(403, 'AN ERROR OCCURED');
        }

    }

    public function initiatePay()
    {
        if($this->p_type == '1')
        {
            $this->validate(['momo_tel' => 'required']);
            if (!Network::isOrange($this->momo_tel) && !Network::isMTN($this->momo_tel)) {
                abort(403, 'INVALID MTN OR ORANGE PHONE NUMBER');
            } else {
                $phone = preg_replace('/\s*/m', '', $this->momo_tel);
                $type = Network::check($phone);
  
                $payRequest = new Payment($phone, preg_replace('/,/', '',$this->vote_amount));
                $pay = $payRequest->pay();
                if($pay->success){
                    $this->payStatus = true;
                    $this->paidVote($this->slug,$type);
                } else {
                   abort(403, 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN');
                }
            }
        } elseif($this->p_type == '2')
        {
            $this->callFlutter();
        }
        else {
            abort(403, 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN');
        }
    }

    public function vote(Candidate $candidate)
    {
        $check = Vote::where('contest_id', $this->contest->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->get();
        if($check)
        {
            $this->vote_succesful = false;
            $this->voted_already = true;
        } else {
            $vote = new Vote();
            $vote->contest_id = $this->contest->id;
            $vote->candidate_id = $candidate->id;
            $vote->vote_count = '1';
            $vote->ip_address = $_SERVER['REMOTE_ADDR'];
            $vote->save();
            $this->voted_already = false;
            $this->vote_succesful = true;
        }
    }

    public function paidVote($candidate,$type)
    {
        $cand = Candidate::where('slug', $candidate)->first();
        $vote = new Vote();
        $vote->contest_id = $this->contest->id;
        $vote->candidate_id = $cand->id;
        $vote->vote_count = $this->vote_count;
        $vote->ip_address = $_SERVER['REMOTE_ADDR'];
        $vote->payment_type = $type;
        $vote->payment_status = 'SUCCESS';
        $vote->amount = (int)currency(preg_replace('/,/', '',$this->vote_amount), $from = $this->currency, $to = $this->contest->currency, $format = false);
        $vote->currency = $this->contest->currency;
        $vote->save();
        Session::flash('message_success', 'Vote Successful. '.$this->vote_count.' vote(s) added to '.$cand->name); 
        $this->redirect(route('vote.candidate', $this->contest->slug));
    }
}
