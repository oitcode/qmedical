<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Payment;
use App\Expense;

use Carbon\Carbon;

class CounterCashComponent extends Component
{
    public $counterCash = 0;

    public $todayPayment = 0;
    public $duePayment = 0;
    public $expense = 0;
    public $netBalance = 0;

    public $searchDate;

    protected $listeners = [
        // TODO
    ];


    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        $this->todayPayment = $this->getPayment('today');
        $this->duePayment = $this->getPayment('due');
        $this->expense = $this->getExpense();
        $this->netBalance = $this->todayPayment + $this->duePayment - $this->expense;

        return view('livewire.counter-cash-component');
    }

    public function getPayment($type)
    {
        $total = 0;

        if  ($type === 'today') {
            $todayPayments = Payment::whereDate('created_at', '=', $this->searchDate)
                ->where('type', 'cash')
                ->get();
        } else if ($type === 'due') {
            $todayPayments = Payment::whereDate('created_at', '=', $this->searchDate)
                ->whereIn('type', ['due', 'loan',])
                ->get();
        } else {
            //
        }

        foreach ($todayPayments as $payment) {
            $total += $payment->amount;
        }

        return $total;
    }

    public function getExpense()
    {
        $total = 0;

        $expenses = Expense::whereDate('date', '=', $this->searchDate)->get();

        foreach ($expenses as $expense) {
            $total += $expense->amount;
        }

        return $total;
    }

    public function nextDay()
    {
        $this->searchDate = $this->searchDate->addDay();
    }

    public function previousDay()
    {
        $this->searchDate = $this->searchDate->subDay();
    }
}
