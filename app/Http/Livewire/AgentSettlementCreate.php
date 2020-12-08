<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\AgentSettlement;

class AgentSettlementCreate extends Component
{
    public $agent = null;

    public $date = "";
    public $comment = "";

    public function render()
    {
        return view('livewire.agent-settlement-create');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'date' => 'required',
            'comment' => 'nullable',
        ]);

        /* This would be better */
        // AgentSettlement::create($validatedData);

        /* Get the last medical_test from agent */
        $lastMedicalTest = $this->agent->medicalTests()->latest('medical_test_id')->first();

        $agentSettlement = new AgentSettlement;

        $agentSettlement->agent_id = $this->agent->agent_id;
        $agentSettlement->medical_test_id = $lastMedicalTest->medical_test_id;
        $agentSettlement->date = $this->date;
        $agentSettlement->comment = $this->comment;

        $agentSettlement->save();

        $this->emitUp('agentSettlementAdded');
        $this->emit('toggleAgentSettlementCreateModal');
    }
}
