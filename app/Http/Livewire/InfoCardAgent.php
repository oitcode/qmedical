<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Agent;

class InfoCardAgent extends Component
{
    public $agentCount;

    public $listeners = ['agentAdded' => 'render'];

    public function render()
    {
        $this->agentCount = Agent::count();

        return view('livewire.info-card-agent');
    }
}
