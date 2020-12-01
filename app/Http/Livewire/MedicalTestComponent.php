<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;

class MedicalTestComponent extends Component
{
    public $medicalTests;
    public $createMode = false;

    protected $listeners = ['medicalTestAdded' => 'finishCreate'];

    public function render()
    {
        $this->medicalTests = MedicalTest::all();

        return view('livewire.medical-test-component');
    }

    public function create()
    {
        $this->createMode = true;
    }

    public function finishCreate()
    {
        $this->createMode = false;
    }
}
