<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Malico\MeSomb\Application;
use Malico\MeSomb\Transactions;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
  


class FinanceComponent extends Component
{
    use WithPagination;

    public $balance, $transactions;
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

}
