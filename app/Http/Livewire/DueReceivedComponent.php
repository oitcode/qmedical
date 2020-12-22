<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Carbon\Carbon;

use App\Payment;

class DueReceivedComponent extends Component
{
    public $searchDate;

    public $duesReceived = null;

    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        $this->duesReceived = Payment::where('type', 'due')
            ->whereDate('created_at', $this->searchDate)
            ->get();

        // foreach ($this->duesReceived as $key => $value) {
        //     if ($value->medicalTest->date === $this->searchDate->toDateString()) {
        //         $this->duesReceived->forget($key);
        //     }
        // }

        return view('livewire.due-received-component');
    }
}
