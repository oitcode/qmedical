<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Agent;
use App\AgentTransaction;
use App\AgentLoan;

class AgentCreate extends Component
{
    public $name;
    public $sex;
    public $email;
    public $contact_number;
    public $comment;
    public $balance = null;

    public function render()
    {
        return view('livewire.agent-create');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'sex' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|regex:/^[0-9]*$/',
            'comment' => 'nullable',
            'balance' => 'nullable|integer',
        ]);

        DB::transaction(function ()
            use ($validatedData) {
            $agent = Agent::create($validatedData);

            /* Create first agent_transaction if needed. */
            if ($this->balance != null) {
                $agentTransaction = new AgentTransaction;

                $agentTransaction->agent_id = $agent->agent_id;

                $direction = 'in';
                $agentTransaction->amount = $this->balance;

                if ($this->balance < 0) {
                    $direction = 'out';
                    $agentTransaction->amount *= -1;

                    /* Create agent_loan */
                    $agentLoan = new AgentLoan;
                    $agentLoan->agent_id = $agent->agent_id;
                    $agentLoan->amount = $this->balance * (-1);
                    $agentLoan->payment_status = 'pending';
                    $agentLoan->save();
                }

                $agentTransaction->direction = $direction;
                $agentTransaction->comment = 'opening';

                $agentTransaction->save();
            }
        });

        $this->emitUp('agentAdded');
        $this->emit('toggleAgentCreateModal');
    }
}
