<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;

class MedicalTestComponent extends Component
{
    public $medicalTests;
    public $createMode = false;

    public $displayMode = false;
    public $displayedMedicalTest = null;

    protected $listeners = [
        'destroyCreate' => 'exitCreateMode',
        'createCancelled' => 'exitCreateMode',
        'medicalTestAdded' => 'finishCreate',
        'displayMedicalTest' => 'displaySingleMedicalTest',
        'destroyDisplay' => 'exitDisplayMode',
        'displayCancelled' => 'exitDisplayMode',
        'createCancel' => 'exitCreateMode',
    ];

    public function render()
    {
        $this->medicalTests = MedicalTest::all();

        return view('livewire.medical-test-component');
    }

    public function create()
    {
        $this->createMode = true;
    }

    public function finishCreate()
    {
        $this->createMode = false;
        $this->emit('dataAdded');
    }

    public function exitCreateMode()
    {
        $this->createMode = false;
    }

    public function enterDisplayMode()
    {
        $this->displayMode = true;
    }

    public function exitDisplayMode()
    {
        $this->displayMedicalTest = null;
        $this->displayMode = false;
    }

    public function displaySingleMedicalTest(MedicalTest $medicalTest)
    {
        $this->enterDisplayMode();
        $this->displayedMedicalTest = null;
        $this->displayedMedicalTest = $medicalTest;
        $this->render();
    }
}
