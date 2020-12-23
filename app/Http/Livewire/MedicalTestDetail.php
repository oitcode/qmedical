<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MedicalTestDetail extends Component
{
    public $medicalTest = null;

    public $statusUpdateMode = false;
    public $newStatus = '';
    public $result = '';

    public function render()
    {
        return view('livewire.medical-test-detail');
    }

    public function cancelDisplay()
    {
        $this->emit('displayCancelled');
    }

    public function refreshDisplay()
    {
        $this->render();
    }

    public function updateStatus()
    {
        $this->statusUpdateMode = true;       
    }

    public function exitUpdateStatus()
    {
        $this->resetStatusData();
        $this->statusUpdateMode = false;       
    }

    public function resetStatusData()
    {
        $this->newStatus = '';
        $this->result = '';
    }

    public function saveNewStatus()
    {
        $validatedData = $this->validate([
            'newStatus' => 'required|string',
            'result' => 'required|string',
        ]);

        $this->medicalTest->status = $this->newStatus;
        $this->medicalTest->result = $this->result;

        $this->medicalTest->save();

        $this->exitUpdateStatus();
        $this->emit('medicalTestStatusUpdated');
    }
}
