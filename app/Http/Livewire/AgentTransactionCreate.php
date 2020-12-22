<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\AgentTransaction;
use App\Agent;
use App\MedicalTest;
use App\Payment;

class AgentTransactionCreate extends Component
{
    public $agent; 

    public $date = "";
    public $direction = "";
    public $amount = "";
    public $comment = "";

    public function render()
    {
        return view('livewire.agent-transaction-create');
    }

    public function store()
    {
        /* Validate data */
        $validatedData = $this->validate([
            'date' => 'required|date',
            'direction' => 'required',
            'amount' => 'required|integer',
            'comment' => 'string',
        ]);

        $validatedData['agent_id'] = $this->agent->agent_id;

        AgentTransaction::create($validatedData);

        /* Clear any official pending. */
        if (strtolower($this->direction) === 'in') {
            if ($this->hasOfficialDue($this->agent)) {
                $this->clearOfficialDues($this->agent, $this->amount);
            }
        }

        $this->emit('agentTransactionAdded');
    }

    public function hasOfficialDue($agent)
    {
        if ($agent->medicalTests()
            ->whereIn('payment_status', ['pending', 'partially_paid',])
            ->get()) {
            return true;
        }

        return false;
    }

    public function clearOfficialDues($agent, $topup)
    {
        $dues = $agent->medicalTests()
            ->whereIn('payment_status', ['pending', 'partially_paid',])
            ->get();

        foreach ($dues as $medicalTest) {
            if ($topup > 0) {
                $topup = $this->payDue($medicalTest, $topup);
            } else {
                /* No more balance to pay. */
                break;
            }
        }
    }

    public function payDue($medicalTest, $topup)
    {
        $payment = new Payment;
        $payment->medical_test_id = $medicalTest->medical_test_id;

        if ($topup >= $this->getDueAmount($medicalTest)) {

            /*
             * If sufficient balance.
             */

            $payment->amount = $this->getDueAmount($medicalTest);
            $topup -= $this->getDueAmount($medicalTest);
            $medicalTest->payment_status = 'paid';
        } else {
            /* Not enough topup to pay fully. Make a partial payment. */

            $payment->amount = $topup;
            $medicalTest->payment_status = 'partially_paid';
            $topup = 0;
        }

        $payment->type = 'due';
        $payment->save();

        $medicalTest->save();

        return $topup;
    }

    public function getDueAmount($medicalTest)
    {
        $dueAmount = $medicalTest->price - $medicalTest->agent_commission;

        if ($medicalTest->payment_status === 'partially_paid') {
            $dueAmount -= $this->getPaidAmount($medicalTest);
        }

        return $dueAmount;
    }

    public function getPaidAmount($medicalTest)
    {
        $amount = 0;

        foreach ($medicalTest->payments as $payment) {
            $amount += $payment->amount;
        }

        return $amount;
    }
}
