<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;
use App\MedicalTestType;
use App\MedicalTest;

class PendingBillListComponent extends Component
{
    public $agents = null;
    public $medicalTestTypes = null;

    public $medicalTests = null;

    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();


        return view('livewire.pending-bill-list-component');
    }
}
