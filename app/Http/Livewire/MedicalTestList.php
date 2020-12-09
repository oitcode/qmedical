<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;

class MedicalTestList extends Component
{
    public $medicalTests;
    public $createMode = false;

    protected $listeners = [
        'dataAdded' => 'render',
        'updateList' => 'render',
        'refreshMedicalTestList' => 'render',
    ];

    public function render()
    {
        $this->medicalTests = MedicalTest::all()->sortByDesc('medical_test_id');

        return view('livewire.medical-test-list');
    }
}
