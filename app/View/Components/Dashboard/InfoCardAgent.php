<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

use App\Agent;


class InfoCardAgent extends Component
{
    public $bgType;
    public $agentCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bgType)
    {
        $this->agentCount = Agent::count();
        $this->bgType = $bgType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.info-card-agent');
    }
}
