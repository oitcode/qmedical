<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\AgentTransaction;

class AgentTransactionCreate extends Component
{
    public $agent = null; 

    public $date = "";
    public $direction = "";
    public $amount = "";
    public $comment = "";

    public function render()
    {
        return view('livewire.agent-transaction-create');
    }

    public function store()
    {
        /* Validate data */
        $validatedData = $this->validate([
            'date' => 'required|date',
            'direction' => 'required',
            'amount' => 'required|integer',
            'comment' => 'nullable',
        ]);

        $validatedData['agent_id'] = $this->agent->agent_id;

        AgentTransaction::create($validatedData);

        $this->emit('agentTransactionAdded');
    }
}
