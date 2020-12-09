<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardNew extends Component
{
    public $displayingComponent = null;

    public $modelName = ""; 
    public $model = null;

    protected $listeners = [
        'displayComponentInDash' => 'loadComponentInDash',
    ];

    public function render()
    {
        //return view('livewire.dashboard-component');
        return view('livewire.dashboard-new');
    }

    public function resetDisplayingComponent()
    {
        $this->displayingComponent = null;
        $this->modelName = "";
        $this->model = null;
    }

    public function loadComponentInDash($displayingComponent, $modelName, $model)
    {
        $this->resetDisplayingComponent();

        $this->displayingComponent = $displayingComponent;
        $this->modelName = $modelName;
        $this->model = $model;
    }
}
