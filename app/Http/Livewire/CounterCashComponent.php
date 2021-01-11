<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Payment;
use App\Expense;
use App\MedicalTest;

use Carbon\Carbon;

class CounterCashComponent extends Component
{
    public $counterCash = 0;

    public $todayPayment = 0;
    public $todayCreditSalesTotal = 0;
    public $duePayment = 0;
    public $expense = 0;
    public $netBalance = 0;

    public $searchDate;
    public $searchStartDate = null;
    public $searchEndDate = null;

    protected $listeners = [
        // TODO
    ];


    public function mount()
    {
        $this->searchStartDate = Carbon::today()->toDateString();
    }

    public function render()
    {
        $this->todayPayment = $this->getPayment('today');
        $this->duePayment = $this->getPayment('due');
        $this->expense = $this->getExpense();
        $this->netBalance = $this->todayPayment + $this->duePayment - $this->expense;
        $this->todayCreditSalesTotal = $this->getTodayCreditSalesTotal();

        return view('livewire.counter-cash-component');
    }

    public function getPayment($type)
    {
        $total = 0;

        if  ($type === 'today') {
            if ($this->searchEndDate !== null) {
                $todayPayments = Payment::whereBetween('date', [$this->searchStartDate, $this->searchEndDate])
                    ->where('type', 'cash')
                    ->get();
            
            } else {
                $todayPayments = Payment::where('date', $this->searchStartDate)
                    ->where('type', 'cash')
                    ->get();
            
            }
        } else if ($type === 'due') {
            if ($this->searchEndDate !== null) {
                $todayPayments = Payment::whereBetween('date', [$this->searchStartDate, $this->searchEndDate])
                    ->whereIn('type', ['due', 'loan',])
                    ->get();
            } else {
                $todayPayments = Payment::where('date', $this->searchStartDate)
                    ->whereIn('type', ['due', 'loan',])
                    ->get();
            
            }
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

        if ($this->searchEndDate !== null) {
            $expenses = Expense::whereBetween('date', [$this->searchStartDate, $this->searchEndDate,])
                ->get();
        } else {
            $expenses = Expense::where('date', $this->searchStartDate)
                ->get();
        }


        foreach ($expenses as $expense) {
            $total += $expense->amount;
        }

        return $total;
    }

    public function nextDay()
    {
        $this->searchStartDate = Carbon::create($this->searchStartDate)->addDay()->toDateString();
    }

    public function previousDay()
    {
        $this->searchStartDate = Carbon::create($this->searchStartDate)->subDay()->toDateString();
    }

    public function getTodayCreditSalesTotal()
    {
        $total = 0;

        if ($this->searchEndDate !== null) {
            $todayCreditSales = MedicalTest::whereBetween('date', [$this->searchStartDate, $this->searchEndDate,])
                ->whereIn('payment_status', ['partially_paid', 'pending',])
                ->get();
        } else {
            $todayCreditSales = MedicalTest::where('date', $this->searchStartDate)
                ->whereIn('payment_status', ['partially_paid', 'pending',])
                ->get();
        }

        foreach ($todayCreditSales as $creditSale) {
            $total += $creditSale->getActualPrice();
        }

        return $total;
    }

    public function setSearchDate()
    {
        //
    }
}
