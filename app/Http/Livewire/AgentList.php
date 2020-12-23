<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;

class AgentList extends Component
{
    protected $listeners = [
        'dataAdded' => 'render',
        'searchAgent' => 'search',
        'agentTransactionAdded' => 'render',
    ];

    public $agents = null;

    public function render()
    {
        return view('livewire.agent-list');
    }

    public function search($agentSearchName)
    {
        $this->agents = Agent::where('name', 'like', '%'.$agentSearchName.'%')->get();
    }
}
