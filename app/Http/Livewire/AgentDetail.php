<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgentDetail extends Component
{
    public $agent;

    public $compDisplayMode = "";

    public $settlementMode = false;
    public $agentTransactionMode = false;
    public $agentTransactions = null;

    public $latestSettlement = null;
    public $latestSettlementDate;

    public $amountToPay;
    public $amountToReceive;

    public $netBalance = [
        'action' => '',
        'amount' => 0,
    ];

    public $recentMedicalTests = null;

    public $viewPrevious = false;
    public $allMedicalTests = null;

    protected $listeners = [
        'closeAgentSettlement' => 'closeSettlementComponent',
        'agentTransactionAdded' => 'exitAgentTransactionMode',
    ];


    public function render()
    {
        $this->agentTransactions = $this->agent->agentTransactions;
        $this->getLastSettlementInfo();

        $this->amountToPay = $this->calculateAmountToPay();
        $this->amountToReceive = $this->calculateAmountToReceive();
        $this->setRecentMedicalTests();

        $this->calculateNetBalane();

        return view('livewire.agent-detail');
    }

    public function calculateAmountToPay()
    {
        $total = 0;

        if ($this->latestSettlement) {
            $medicalTests = $this->agent->medicalTests()
                ->where('medical_test_id', '>', $this->latestSettlement->medical_test_id )
                ->get();
        } else {
            $medicalTests = $this->agent->medicalTests;
        }


        if ($medicalTests) {
            foreach ($medicalTests as $medicalTest) {
                if ($medicalTest->agent_commission_status === "Pending") {
                    $total += $medicalTest->agent_commission;
                }
            }
        }

        return $total;
    }

    public function calculateAmountToReceive()
    {
        $total = 0;

        if ($this->latestSettlement) {
            $medicalTests = $this->agent->medicalTests()
                ->where('medical_test_id', '>', $this->latestSettlement->medical_test_id )
                ->get();
        } else {
            $medicalTests = $this->agent->medicalTests;
        }

        if ($medicalTests) {
            foreach ($medicalTests as $medicalTest) {
                if ($medicalTest->payment_status === "Pending") {
                    $total += $medicalTest->price;
                }
            }
        }

        return $total;
    }

    public function getLastSettlementInfo()
    {
        $this->latestSettlement = $this->agent->agentSettlements()->latest('agent_settlement_id')->first();

        if (!$this->latestSettlement) {
            $this->latestSettlement = null;
            $this->latestSettlementDate = "No previous settlement";
        } else {
            $this->latestSettlementDate = $this->latestSettlement->date;
        }
    }

    public function calculateNetBalane()
    {
        if ($this->amountToPay > $this->amountToReceive) {
            $this->netBalance['action'] = 'Pay';
            $this->netBalance['amount'] = $this->amountToPay - $this->amountToReceive;
        } else if ($this->amountToPay < $this->amountToReceive) {
            $this->netBalance['action'] = 'Receive';
            $this->netBalance['amount'] = $this->amountToReceive - $this->amountToPay;
        } else {
            $this->netBalance['action'] = 'None';
            $this->netBalance['amount'] = 0;
        }
    }

    public function setRecentMedicalTests()
    {
        if ($this->latestSettlement) {
            $this->recentMedicalTests = $this->agent->medicalTests()
                ->where('medical_test_id', '>', $this->latestSettlement->medical_test_id )
                ->get();
        } else {
            $this->recentMedicalTests = $this->agent->medicalTests;
        }
    }

    public function showViewPrevious()
    {
        $this->allMedicalTests = $this->agent->medicalTests;
        $this->viewPrevious = true;
    }

    public function hideViewPrevious()
    {
        $this->viewPrevious = false;
    }

    public function enterSettlementMode()
    {
        $this->settlementMode = true;
    }

    public function closeSettlementComponent()
    {
        $this->settlementMode = false;
    }

    public function enterAgentTransactionMode()
    {
        $this->agentTransactionMode = true;
    }

    public function exitAgentTransactionMode()
    {
        $this->agentTransactionMode = false;
    }
}
