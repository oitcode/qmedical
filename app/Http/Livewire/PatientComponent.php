<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Patient;

class PatientComponent extends Component
{
    public $patients;

    public $updateMode = false;

    public function render()
    {
        $this->patients = Patient::orderBy('patient_id', 'desc')->get();

        return view('livewire.patient-component');
    }

    public function store()
    {
    }

    public function edit($id)
    {
    }

    public function update()
    {
    }

    public function resetInputFields()
    {
    }

    public function delete($id)
    {
    }
}
