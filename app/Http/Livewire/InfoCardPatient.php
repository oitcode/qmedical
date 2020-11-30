<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Patient;

class InfoCardPatient extends Component
{
    public $patientCount;

    public $listeners = ['patientAdded', 'render'];

    public function render()
    {
        $this->patientCount = Patient::count();

        return view('livewire.info-card-patient');
    }
}
