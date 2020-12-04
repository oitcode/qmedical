<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;

class MedicalTestList extends Component
{
    public $medicalTests;
    public $createMode = false;

    protected $listeners = ['dataAdded' => 'render'];

    public function render()
    {
        $this->medicalTests = MedicalTest::all();

        return view('livewire.medical-test-list');
    }
}
