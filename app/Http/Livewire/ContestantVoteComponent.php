<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\PayRequest;
use App\Models\Utils\Currency;
use Illuminate\Support\Str;
use Malico\MeSomb\Payment;
use Malico\MobileCM\Network;
use Session;
use Illuminate\Support\Facades\Http;
use App\Helpers\Paymooney;

class ContestantVoteComponent extends Component
{
    public Contest $contest;
    public Candidate $candidate;
    public $candidates;
    public $viewCandidate, $showText = false;
    public $text_words = 15;
    public $vote_payment, $voted_already, $vote_succesful = false;
    public $data, $refs, $slug, $p_type, $free_vote, $fee, $momo_tel, $name, $tel, $email;
    public $currencies, $vote_fee, $currency, $vote_count, $vote_amount, $currency_symbol, $vp;



    public function mount()
    {
        $this->currencies = Currency::all();
        $this->currency = $this->contest->currency;
        $this->refs = 'SHOSA-'.Str::random(20);
    }

    public function render()
    {
        $candidates = $this->contest->candidates;
        $cands = $candidates->transform(function ($cand, $key) {
            $vote_number = $cand->votes()->sum('vote_count');
            $cand->vote_count = $vote_number;
            return $cand;
        });
        $this->candidates = $cands;
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

    public function initiatePay()
    {
       
        $data = [
            'amount' => $this->vote_amount,
            'currency' => $this->currency,
            'candidate_id' => $this->candidate->id,
            'vote_count' => $this->vote_count,
        ];
        $paymentRegistration = $this->registerPayment($data); 
        $ref = 'SHOSA-V'.$paymentRegistration->id.'-'.Str::random(20);
        $payment = new Paymooney();
        $payment_url = $payment->generatePaymentUrl($data['amount'], $data['currency'], $paymentRegistration->id, $ref);
        return redirect($payment_url);
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


//Register payment info before sending payment request
    public function registerPayment($data)
    {
        $pr = new PayRequest();
        $pr->amount = $data['amount'];
        $pr->currency = $data['currency'];
        $pr->vote_count = $data['vote_count'];
        $pr->status = "PENDING";
        $pr->candidate_id = $data['candidate_id'];
        $pr->save();
        return $pr;
    }
}
