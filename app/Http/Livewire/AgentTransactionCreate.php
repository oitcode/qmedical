<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\AgentTransaction;
use App\Agent;
use App\MedicalTest;
use App\PartialPayment;

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
        if ($topup >= $this->getDueAmount($medicalTest)) {
            if ($medicalTest->payment_status === 'partially_paid') {

                /*
                 * Already partially paid case.
                 */
                
                $topup -= $this->getDueAmount($medicalTest);

                /* Create remaining partial payment. */
                $partialPayment = new PartialPayment;

                $partialPayment->medical_test_id = $medicalTest->medical_test_id;
                $partialPayment->amount = $this->getDueAmount($medicalTest);

                $partialPayment->save();
            } else {

                /*
                 * No previous partial payments.
                 */
                
                $topup -= $this->getDueAmount($medicalTest);
            }

            $medicalTest->payment_status = 'paid';
            $medicalTest->save();
        } else {
            /* Not enough topup to pay fully. Make a partial payment. */

            $partialPayment = new PartialPayment;

            $partialPayment->medical_test_id = $medicalTest->medical_test_id;
            $partialPayment->amount = $topup;

            $partialPayment->save();

            $medicalTest->payment_status = 'partially_paid';
            $medicalTest->save();

            $topup = 0;
        }

        return $topup;
    }

    public function getDueAmount($medicalTest)
    {
        $dueAmount = $medicalTest->price - $medicalTest->agent_commission;

        if ($medicalTest->payment_status === 'partially_paid') {
            $dueAmount -= $this->getPartiallyPaidAmount($medicalTest);
        }

        return $dueAmount;
    }

    public function getPartiallyPaidAmount($medicalTest)
    {
        $amount = 0;

        foreach ($medicalTest->partialPayments as $partialPayment) {
            $amount += $partialPayment->amount;
        }

        return $amount;
    }
}
