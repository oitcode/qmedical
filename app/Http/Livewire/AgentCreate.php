<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;

class AgentCreate extends Component
{
    public $name;
    public $sex;
    public $email;
    public $contact_number;
    public $comment;

    public function render()
    {
        return view('livewire.agent-create');
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

        $this->emitUp('agentAdded');
        $this->emit('toggleAgentCreateModal');
    }
}
