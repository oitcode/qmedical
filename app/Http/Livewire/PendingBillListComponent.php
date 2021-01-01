<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Agent;
use App\MedicalTestType;
use App\MedicalTest;
use App\AgentLoan;

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
    public $pendingAgentLoans = null;

    public $fullScreenTrue = false;

    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();

        $this->search();

        return view('livewire.pending-bill-list-component');
    }

    public function search()
    {
        /*
         * Pending Medical Tests
         */

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


        /*
         * Pending Agent Loans
         */

        if (!$this->medicalTestTypeId) {
            $pendingAgentLoans = AgentLoan::whereIn('payment_status', ['partially_paid', 'pending',]);

            /* Filter for agent */
            if ($this->agentId) {
                $pendingAgentLoans = $pendingAgentLoans->where('agent_id', $this->agentId);
            }

            $this->pendingAgentLoans = $pendingAgentLoans->get();
        } else {
            $this->pendingAgentLoans = null;;
        }

        /* Update count and total */
        $this->pendingCount = $this->medicalTests->count();
        $this->pendingAmountTotal = $this->getPendingAmountTotal($this->medicalTests)
            + $this->getAgentLoanPendingAmountTotal($this->pendingAgentLoans);
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

    public function getAgentLoanPendingAmountTotal($agentLoans)
    {
        $total = 0;

        if ($agentLoans === null) {
            return $total;
        }

        foreach ($agentLoans as $agentLoan) {
            $total += $agentLoan->getPendingAmount();
        }

        return $total;
    }

    public function goFullScreen()
    {
        $this->fullScreenTrue = true;
    }

    public function exitFullScreen()
    {
        $this->fullScreenTrue = false;
    }

    public function toggleFullScreen()
    {
        $this->fullScreenTrue = !$this->fullScreenTrue;
    }

}
