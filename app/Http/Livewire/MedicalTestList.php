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
        $this->medicalTests = MedicalTest::all()->sortByDesc('medical_test_id');
    }

    public function render()
    {
        return view('livewire.medical-test-list')
          ->with('medicalTests', MedicalTest::orderBy('medical_test_id', 'desc')->paginate(5));
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
