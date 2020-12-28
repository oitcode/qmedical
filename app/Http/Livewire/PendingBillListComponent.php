<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;
use App\MedicalTestType;
use App\MedicalTest;

class PendingBillListComponent extends Component
{
    /* Search selection */
    public $agents = null;
    public $medicalTestTypes = null;

    /* Search parameters */
    public $startDate = null;
    public $endDate = null;
    public $medicalTestTypeId = null;
    public $agentId = null;

    /* Search result */
    public $medicalTests = null;
    public $pendingCount; 
    public $pendingAmountTotal; 

    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();

        $this->search();

        return view('livewire.pending-bill-list-component');
    }

    public function search()
    {
        $medicalTests = MedicalTest::whereIn('payment_status', ['partially_paid', 'pending',]);


        /* Filter for dates */

        /* Single day */
        if ($this->startDate && !$this->endDate) {
            $medicalTests = $medicalTests->whereDate('date', '=', $this->startDate);
        }

        /* Range of days */
        if ($this->startDate && $this->endDate) {
            $medicalTests = $medicalTests->whereDate('date', '>=', $this->startDate);
            if ($this->endDate) {
                $medicalTests = $medicalTests->whereDate('date', '<=', $this->endDate);
            }
        }

        /* Filter for medical_test type */
        if ($this->medicalTestTypeId) {
            $medicalTests = $medicalTests->where('medical_test_type_id', $this->medicalTestTypeId);
        }

        /* Filter for agent type */
        if ($this->agentId) {
            $medicalTests = $medicalTests->where('agent_id', $this->agentId);
        }

        $this->medicalTests = $medicalTests->get();

        /* Update count and total */
        $this->pendingCount = $this->medicalTests->count();
        $this->pendingAmountTotal = $this->getPendingAmountTotal($this->medicalTests);
    }

    public function getPendingAmountTotal($bills)
    {
        $total = 0;

        foreach ($bills as $bill) {
            $total += $this->getPendingAmount($bill);
        }

        return $total;
    }

    public function getPendingAmount($bill)
    {
        $pendingAmount = $bill->price;
        if ($bill->agent_id) {
            $pendingAmount -= $bill->agent_commission;
        }

        if (strtolower($bill->payment_status) === 'partially_paid') {
            foreach ($bill->payments as $payment) {
                $pendingAmount -= $payment->amount;       
            }
        }

        return $pendingAmount;
    }
}
