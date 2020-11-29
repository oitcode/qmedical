<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;

class MedicalTestComponent extends Component
{
    public $medicalTests;

    public function render()
    {
        $this->medicalTests = MedicalTest::all();

        return view('livewire.medical-test-component');
    }
}
