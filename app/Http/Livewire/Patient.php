<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Patient extends Component
{
    public $patients, $patient_id, $name, $sex, $dob;
    public $updateMode = false;

    public function render()
    {
        $this->patients = \App\Patient::all();

        return view('livewire.patient');
    }

    public function resetInputFields()
    {
        $this->patient_id = '';
        $this->name = '';
        $this->sex = '';
        $this->dob = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
        ]);

        \App\Patient::create($validatedData);
        session()->flash('message', 'Patient Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $patient = \App\Patient::findOrFail($id);

        $this->patient_id = $id;
        $this->name = $patient->name;
        $this->sex = $patient->sex;
        $this->dob = $patient->dob;

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
        ]);


        $patient = \App\Patient::find($this->patient_id);
        $patient->update([
            'name' => $this->name,
            'sex' => $this->sex,
            'dob' => $this->dob,
        ]);

        $this->updateMode = false;
        session()->flash('message', 'Patient Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        \App\Patient::find($id)->delete();
        session()->flash('message', 'Patient Deleted Successfully.');
    }
}
