<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;
use App\AgentTransaction;

class AgentCreate extends Component
{
    public $name;
    public $sex;
    public $email;
    public $contact_number;
    public $comment;
    public $balance;

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
            'balance' => 'required|integer',
        ]);

        $agent = Agent::create($validatedData);

        /* Starting Balance */
        $agentTransaction = new AgentTransaction;

        $agentTransaction->agent_id = $agent->agent_id;

        $direction = 'in';
        $agentTransaction->amount = $this->balance;

        if ($this->balance < 0) {
            $direction = 'out';
            $agentTransaction->amount *= -1;
        }

        $agentTransaction->direction = $direction;
        $agentTransaction->comment = 'opening';

        $agentTransaction->save();

        $this->emitUp('agentAdded');
        $this->emit('toggleAgentCreateModal');
    }
}
