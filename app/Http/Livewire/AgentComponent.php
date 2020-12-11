<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;

class AgentComponent extends Component
{
    public $agents;
    public $createInProgress;
    public $updateInProgress;

    /* Different modes of this component. */
    public $createMode = false;
    public $displayMode = false;
    public $displayedAgent = null;
    public $updateMode = false;
    public $updatingAgent = null;

    public $settlementMode = false;
    public $settlingAgent = null;

    protected $listeners = [
        'agentAdded' => 'finishCreate',
        'destroyAgentCreate' => 'exitCreateMode',
        'displayAgent' => 'displaySingleAgent',
        'destroyDisplay' => 'exitDisplayMode',
        'deleteAgent',
        'updateAgent',
        'destroyAgentUpdate' => 'exitUpdateMode',
        'makeAgentSettlement',
        'agentSettlementAdded' => 'exitSettlementMode',
        /* Better to update settlingAgent rather than just exit. */
        'destroyAgentSettlementCreate' => 'exitSettlementMode',
        'agentUpdated' => 'finishUpdate',
    ];

    public function render()
    {
        $this->agents = Agent::all();

        return view('livewire.agent-component');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'sex' => 'required',
            'email' => 'nullable',
            'contact_number' => 'nullable',
            'comment' => 'nullable',
        ]);

        Agent::create($validatedData);
        session()->flash('message', 'Agent Created Successfully.');
        //$this->resetInputFields();
        $this->emit('agentAdded');
    }

    public function create()
    {
        $this->enterCreateMode();
    }

    public function enterCreateMode()
    {
        $this->createMode = true;
    }

    public function exitCreateMode()
    {
        $this->createMode = false;
    }

    public function finishCreate()
    {
        $this->emit('dataAdded');
    }

    public function deleteAgent($id)
    {
        Agent::findOrFail($id)->delete();
        $this->emit('updateList');
    }

    public function exitDisplayMode()
    {
        $this->displayedAgent = null;
        $this->displayMode = false;
    }

    public function displaySingleAgent(Agent $agent)
    {
        $this->enterDisplayMode();
        $this->displayedAgent = $agent;
        $this->render();
        // $this->emit('displayComponentInDash', 'agent-detail', 'agent', $agent);
    }

    public function enterDisplayMode()
    {
        $this->displayMode = true;
    }

    public function exitUpdateMode()
    {
        $this->updatingAgent = null;
        $this->updateMode = false;
    }

    public function updateAgent(Agent $agent)
    {
        $this->updatingAgent = $agent;
        $this->enterUpdateMode();
    }

    public function enterUpdateMode()
    {
        $this->updateMode = true;
    }

    public function enterSettlementMode()
    {
        $this->settlementMode = true;
    }

    public function exitSettlementMode()
    {
        $this->settlementMode = false;
    }

    public function makeAgentSettlement(Agent $agent)
    {
        $this->settlingAgent = $agent;
        $this->enterSettlementMode();
    }

    public function finishUpdate()
    {
        $this->emit('dataAdded');
    }
}
