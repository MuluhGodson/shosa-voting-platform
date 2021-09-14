<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Malico\MeSomb\Application;
use Malico\MeSomb\Transactions;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Malico\MeSomb\Deposit;
use Malico\MobileCM\Network;
use Laravel\Jetstream\ConfirmsPasswords;
use App\Models\Withdrawal;
use Session;
use Illuminate\Support\Facades\Http;
  


class FinanceComponent extends Component
{
    use WithPagination;
    use ConfirmsPasswords;

    public $balance, $transactions, $amount, $phone, $flutCurrency, $flutBalance, $flutLedger, $flutTransactions, $totPages;
    public $openWithdraw, $intlTransactions = false;
    public $locTransactions = true;
    private $base_url = "https://api.flutterwave.com/v3";
    public $page = 1;


    public function getLocalBalance()
    {   
        $app = new Application();
        $this->balance = $app->checkStatus()['balances'];
        $trans = new Transactions();
        $transacts = $trans->getTransactions();
        $this->transactions = $transacts['results'];
    }

    public function getFlutterBalance()
    {
        $balance_response = Http::withToken(config('flutterwave.secret'))
                            ->acceptJson()
                            ->get($this->base_url.'/balances/XAF');
        $balance_response = json_decode($balance_response->body());

        $this->flutCurrency = $balance_response->data->currency;
        $this->flutBalance = $balance_response->data->available_balance;
        $this->flutLedger = $balance_response->data->ledger_balance;


        $transactions_response = Http::withToken(config('flutterwave.secret'))
                                        ->acceptJson()
                                        ->get($this->base_url.'/transactions',
                                        [
                                            'page' => $this->page,
                                        ]);
        $transactions_response = json_decode($transactions_response->body());
        $this->totPages = $transactions_response->meta->page_info->total_pages;
        $this->flutTransactions = $transactions_response->data; 
        //dd($this->flutTransactions);
    }

    public function changePage($t)
    {
        if($t == "n")
        {
            if($this->page < $this->totPages) $this->page = $this->page+1;
        } else {
            $this->page = $this->page - 1;
            if($this->page < 1) $this->page = 1;
        }
        $this->getFlutterBalance();
    }

    public function displayFlut()
    {
        $this->locTransactions = false;
        $this->intlTransactions = true;
    }

    public function displayLoc()
    {
        $this->intlTransactions = false;
        $this->locTransactions = true;
    }

    public function render()
    {
        $this->getLocalBalance();
        $this->getFlutterBalance();

        return view('livewire.finance-component');
    }

    public function withdrawModal()
    {
        $this->dispatchBrowserEvent('tel-number');
        $this->openWithdraw = true;
    }

    public function initiateWithdraw()
    {
        
        $this->ensurePasswordIsConfirmed();

        $this->validate([
            'phone' => 'required',
            'amount' => 'required'
        ]);
        if (!Network::isOrange($this->phone) && !Network::isMTN($this->phone)) {
            abort(403, 'INVALID MTN OR ORANGE PHONE NUMBER');
        } else {
            $orange_balance = $this->balance[0]['value'];
            $mtn_balance = $this->balance[1]['value'];

            $this->phone = preg_replace('/\s*/m', '', $this->phone);
            $type = Network::check($this->phone);
         
            if(($type == "orange") && (preg_replace('/,/', '',$this->amount) > $orange_balance))
            {
                Session::flash('message', 'INSUFFICIENT BALANCE IN YOUR ORANGE MONEY ACCOUNT');
                $this->redirect(route('finance.index'));
            } elseif(($type == "mtn") && ((preg_replace('/,/', '',$this->amount)) > $mtn_balance))
            {
                Session::flash('message', 'INSUFFICIENT BALANCE IN YOUR MTN MOBILE MONEY ACCOUNT');
                $this->redirect(route('finance.index'));
            } else {

                $payRequest = new Deposit($this->phone, preg_replace('/,/', '',$this->amount));
                $pay = $payRequest->pay();
                if($pay->success){
                    $w = new Withdrawal;
                    $w->email = Auth()->User()->email;
                    $w->tel = $this->phone;
                    $w->amount = $this->amount;
                    $w->status = "success";
                    $w->network = $type;
                    $w->save();
                    Session::flash('message_success', 'Withdrawal Successful. '.number_format($this->amount).' FCFA sent to '.$this->phone);
                    $this->redirect(route('finance.index'));
                } else {
                    abort(403, 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN');
                }
            }
        }
        
    }

}
