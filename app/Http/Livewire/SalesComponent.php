<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;
use Carbon\Carbon;

class SalesComponent extends Component
{
    public $sales = null;
    public $searchDate;
    public $salesTotal;

    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        $this->sales = MedicalTest::where('payment_status' , 'paid')
            ->whereDate('date', '=', $this->searchDate)->get();

        $this->salesTotal = $this->getTotalSales($this->sales);

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
