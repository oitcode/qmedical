<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;
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
        $this->cashSales = MedicalTest::where('payment_status' , 'paid')
            ->whereDate('date', '=', $this->searchDate)->get();

        $this->creditSales = MedicalTest::where('payment_status' , 'pending')
            ->whereDate('date', '=', $this->searchDate)->get();

        $this->cashSalesTotal = $this->getTotalSales($this->cashSales);
        $this->creditSalesTotal = $this->getTotalSales($this->creditSales);

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

    public function getTotalSales($sales)
    {
        $total = 0;

        foreach ($sales as $medicalTest) {
            $total += $medicalTest->price;

            if ($medicalTest->agent) {
              $total -= $medicalTest->agent_commission;  
            }
        }


        return $total;
    }
}
