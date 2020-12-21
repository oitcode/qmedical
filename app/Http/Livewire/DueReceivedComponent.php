<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Carbon\Carbon;

class DueReceivedComponent extends Component
{
    public $searchDate;

    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        return view('livewire.due-received-component');
    }
}
