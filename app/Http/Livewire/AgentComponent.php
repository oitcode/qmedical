<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;

class AgentComponent extends Component
{
    public $agents;
    public $createInProgress;
    public $updateInProgress;

    public $name = '';
    public $sex = '';
    public $email = '';
    public $contact_number = '';
    public $comment = '';

    public $createMode = false;
    public $displayMode = false;
    public $displayedAgent = null;

    protected $listeners = [
        'agentAdded' => 'finishCreate',
        'destroyAgentCreate' => 'exitCreateMode',
        'displayAgent' => 'displaySingleAgent',
        'destroyDisplay' => 'exitDisplayMode',
        'deleteAgent',
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
    }

    public function enterDisplayMode()
    {
        $this->displayMode = true;
    }
}
