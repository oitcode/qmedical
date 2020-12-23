<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTestType;

class MedicalTestTypeComponent extends Component
{
    public $medicalTestTypes;

    public $medicalTestTypeId;

    public $name = '';
    public $rate = '';
    public $comment = '';

    public $updateMode = false;

    public function render()
    {
        $this->medicalTestTypes = MedicalTestType::all();

        return view('livewire.medical-test-type-component');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'rate' => 'required',
            'comment' => 'nullable',
        ]);

        MedicalTestType::create($validatedData);
        $this->resetInputFields();

        $this->emitUp('medicalTestTypeAdded');
        $this->emit('toggleMedicalTestTypeCreateModal');
    }

    public function edit($id)
    {
        $medicalTestType = MedicalTestType::findOrFail($id);

        $this->medicalTestTypeId = $id;
        $this->name = $medicalTestType->name;
        $this->rate = $medicalTestType->rate;
        $this->comment = $medicalTestType->comment;

        $this->updateMode = true;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'rate' => 'required',
            'comment' => 'nullable',
        ]);


        $medicalTestType = MedicalTestType::find($this->medicalTestTypeId);
        $medicalTestType->update([
            'name' => $this->name,
            'rate' => $this->rate,
            'comment' => $this->comment,
        ]);

        $this->updateMode = false;
        session()->flash('message', 'Medical Test Type Updated Successfully.');
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->rate = '';
        $this->comment = '';
    }

    public function delete($id)
    {
        MedicalTestType::find($id)->delete();
        session()->flash('message', 'Medical Test Type Deleted Successfully.');
    }
}
