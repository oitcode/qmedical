<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Carbon\Carbon;

use App\Payment;

class DueReceivedComponent extends Component
{
    public $searchDate = false;

    public $duesReceived = null;

    public $dueReceivedTotal;

    protected $listeners = [
        'refreshDeuReceivedList' => 'changeSearchDate',
    ];

    public function mount()
    {
    }

    public function render()
    {
        $this->duesReceived = Payment::where('type', 'due')
            ->whereDate('created_at', $this->searchDate)
            ->get();


        $this->dueReceivedTotal = $this->getDueReceivedTotal($this->duesReceived);

        // foreach ($this->duesReceived as $key => $value) {
        //     if ($value->medicalTest->date === $this->searchDate->toDateString()) {
        //         $this->duesReceived->forget($key);
        //     }
        // }

        return view('livewire.due-received-component');
    }

    public function getDueReceivedTotal($duesReceived)
    {
        $total = 0;

        foreach ($duesReceived as $dueReceived) {
            $total += $dueReceived->amount;
        }

        return $total;
    }

    public function changeSearchDate($searchDate)
    {
        $this->searchDate = $searchDate;
        $this->render();
    }
}
