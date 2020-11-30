<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTestType;

class AnalyticsMedical extends Component
{
    public $startDate;
    public $endDate;

    public $testType;
    public $totalMoneyReceived;

    public $medicalTestTypes;

    public $searchMedicalTestTypeId;

    public $medicalTests = null;

    public $testCount = 0;
    public $totalEarning = 0;

    public function render()
    {
        $this->medicalTestTypes = MedicalTestType::all();

        return view('livewire.analytics-medical');
    }

    public function search()
    {
        $medicalTestType = MedicalTestType::findOrFail($this->searchMedicalTestTypeId);

        $this->medicalTests = $medicalTestType->medicalTests()->whereBetween('date', [$this->startDate, $this->endDate])->get();
        $this->testCount = $this->medicalTests->count();
        $this->updateTotalEarning();
    }

    public function updateTotalEarning()
    {
        $this->totalEarning = 0;

        foreach ($this->medicalTests as $medicalTest) {
            $this->totalEarning += $medicalTest->price;
        }
    }
}
