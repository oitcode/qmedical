<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;

class MedicalTestPendingListComponent extends Component
{
    public $pendingMedicalTests;

    public function render()
    {
        $this->pendingMedicalTests = MedicalTest::where('status', 'waiting')->get();

        return view('livewire.medical-test-pending-list-component');
    }
}
