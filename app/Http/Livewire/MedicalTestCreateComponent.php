<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;

class MedicalTestCreateComponent extends Component
{
    public $agents;
    public $selectedAgent = null;
    public $selectedAgentId = null;

    public function render()
    {
        $this->agents = Agent::all();

        return view('livewire.medical-test-create-component');
    }

    public function selectAgent()
    {
        $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);
    }

    public function undoSelection()
    {
        $this->selectedAgentId = null;
        $this->selectedAgent = null;
    }
}
