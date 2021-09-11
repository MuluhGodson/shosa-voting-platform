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
  


class FinanceComponent extends Component
{
    use WithPagination;
    use ConfirmsPasswords;

    public $balance, $transactions, $amount, $phone;
    public $openWithdraw = false;

    public function mount()
    {
        $app = new Application();
        $this->balance = $app->checkStatus()['balances'];
        $trans = new Transactions();
        $transacts = $trans->getTransactions();
        $this->transactions = $transacts['results'];
    }

    public function render()
    {
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
            $this->phone = preg_replace('/\s*/m', '', $this->phone);
            $type = Network::check($this->phone);

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
