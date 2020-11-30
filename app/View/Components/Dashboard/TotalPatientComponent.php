<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

use App\Patient;

class TotalPatientComponent extends Component
{
    public $totalPatients;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->totalPatients = Patient::count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.total-patient-component');
    }
}
