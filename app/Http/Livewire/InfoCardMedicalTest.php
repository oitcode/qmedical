<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;

class InfoCardMedicalTest extends Component
{
    public $medicalTestCount;

    public function render()
    {
        $this->medicalTestCount = MedicalTest::count();

        return view('livewire.info-card-medical-test');
    }
}
