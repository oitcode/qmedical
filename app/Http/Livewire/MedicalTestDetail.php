<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MedicalTestDetail extends Component
{
    public $medicalTest = null;

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

    // public function updated()
    // {
    //     $this->emit('show');
    //     $this->render();
    // }
}
