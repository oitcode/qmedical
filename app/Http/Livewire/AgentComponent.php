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
}
