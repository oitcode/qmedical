<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgentBalanceDisplay extends Component
{
    public $agent = null;

    public $balance;

    public function render()
    {
        $this->balance = $this->getBalance();

        return view('livewire.agent-balance-display');
    }

    public function getBalance()
    {
        $transactions = $this->agent->agentTransactions;

        $total = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->direction === 'in') {
                $total += $transaction->amount;
            } else {
                $total -= $transaction->amount;
            }
        }

        return $total;
    
    }
}
