<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgentDetail extends Component
{
    public $agent;

    public function render()
    {
        return view('livewire.agent-detail');
    }
}
