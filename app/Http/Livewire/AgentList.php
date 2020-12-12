<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;

//use Livewire\WithPagination;

class AgentList extends Component
{
    //use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'dataAdded' => 'render',
        //'updateList' => 'render',
    ];

    //public $agents = null;

    public function render()
    {
        //$this->agents = null;
        //$this->agents = Agent::all()->sortByDesc('agent_id')->paginate(5);

        return view('livewire.agent-list')
            ->with('agents', Agent::orderBy('agent_id', 'desc')->paginate(50));
    }
}
