<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;

class AgentList extends Component
{
    protected $listeners = [
        'dataAdded' => 'render',
        //'updateList' => 'render',
    ];

    public $agents = null;

    public function render()
    {
        $this->agents = null;
        $this->agents = Agent::all()->sortByDesc('agent_id');
        return view('livewire.agent-list');
    }

    public function hydrate()
    {
    }
}
