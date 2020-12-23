<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;
use App\Payment;
use Carbon\Carbon;

class SalesComponent extends Component
{
    public $searchDate;

    public $cashSales = null;
    public $cashSalesTotal;

    public $creditSales = null;
    public $creditSalesTotal;

    public $duesReceived = null;
    public $dueReceivedTotal;

    public $salesTotal;

    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        $this->cashSales = Payment::whereDate('created_at', '=', $this->searchDate)
            ->where('type', 'cash')
            ->get();

        $this->creditSales = MedicalTest::whereDate('date', '=', $this->searchDate)
            ->whereNotNull('credit_amount')
            ->get();

        $this->duesReceived = Payment::where('type', 'due')
            ->whereDate('created_at', $this->searchDate)
            ->get();

        $this->cashSalesTotal = $this->getTotalCashSales($this->cashSales);
        $this->creditSalesTotal = $this->getTotalCreditSales($this->creditSales);
        $this->dueReceivedTotal = $this->getTotalDueReceived($this->duesReceived);

        $this->salesTotal = $this->cashSalesTotal + $this->creditSalesTotal;

        return view('livewire.sales-component');
    }

    public function getTotalDueReceived($duesReceived)
    {
        $total = 0;

        foreach ($duesReceived as $dueReceived) {
            $total += $dueReceived->amount;
        }

        return $total;
    }

    public function nextDay()
    {
        // $this->searchDate = $this->searchDate->addDay();
        $this->emit('refreshDeuReceivedList', $this->searchDate->addDay());
    }

    public function previousDay()
    {
        // $this->searchDate = $this->searchDate->subDay();
        // $this->emit('refreshDeuReceivedList', $this->searchDate);
        $this->emit('refreshDeuReceivedList', $this->searchDate->subDay());
    }

    public function getTotalCashSales($sales)
    {
        $total = 0;

        foreach ($sales as $payment) {
            $total += $payment->amount;
        }

        return $total;
    }

    public function getTotalCreditSales($sales)
    {
        $total = 0;

        foreach ($sales as $medicalTest) {
            $total += $medicalTest->credit_amount;
        }

        return $total;
    }

    public function getPaidAmount($medicalTest)
    {
        $total = 0;

        foreach ($medicalTest->payments as $payment) {
            $total += $payment->amount;
        }

        return $total;
    }
}
