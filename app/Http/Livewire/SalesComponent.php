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
            ->where(function ($query) {
              $query->where('payment_status', 'pending')
                  ->orWhere('payment_status', 'partially_paid');
            })
            ->get();

        $this->cashSalesTotal = $this->getTotalCashSales($this->cashSales);
        $this->creditSalesTotal = $this->getTotalCreditSales($this->creditSales);

        $this->salesTotal = $this->cashSalesTotal + $this->creditSalesTotal;

        return view('livewire.sales-component');
    }

    public function nextDay()
    {
        $this->searchDate = $this->searchDate->addDay();
    }

    public function previousDay()
    {
        $this->searchDate = $this->searchDate->subDay();
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

            $creditAmount = $medicalTest->price;
            if ($medicalTest->agent_id) {
                $creditAmount -= $medicalTest->agent_commission;
            }

            if (strtolower($medicalTest->payment_status) === 'partially_paid') {
                $creditAmount -= $this->getPaidAmount($medicalTest);
            }

            $total += $creditAmount;
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
