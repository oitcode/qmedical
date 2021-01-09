<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;

class MedicalTestList extends Component
{
    public $createMode = false;

    public $medicalTests = null;

    protected $listeners = [
        'dataAdded' => 'mount',
        'updateList' => 'mount',
        'refreshMedicalTestList' => 'mount',
        'searchMedicalTestByPatientName' => 'searchByPatientName',
        'medicalTestStatusUpdated' => 'mount',
        'agentTransactionAdded' => 'render',
    ];

    public function mount()
    {
        $this->medicalTests = MedicalTest::orderBy('date', 'desc')->limit(20)->get();
    }

    public function render()
    {
        return view('livewire.medical-test-list');
    }

    public function searchByPatientName($patientSearchName)
    {
        $searchName = $patientSearchName;

        $this->medicalTests = MedicalTest::whereHas('patient',
        function ($query) use ($searchName) {
            $query->where('name', 'like', '%' . $searchName .'%');
        })
        ->get();
    }
}
