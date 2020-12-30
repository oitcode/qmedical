<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\AgentTransaction;
use App\Agent;
use App\MedicalTest;
use App\Payment;
use App\AgentLoan;

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
        $oldBalance = $this->agent->getBalance();

        /* Validate data */
        $validatedData = $this->validate([
            'date' => 'required|date',
            'direction' => 'required',
            'amount' => 'required|integer',
            'comment' => 'string',
        ]);

        $validatedData['agent_id'] = $this->agent->agent_id;

        DB::transaction(function ()
            use ($oldBalance, $validatedData) {

            AgentTransaction::create($validatedData);

            /* Clear any official pending if needed. */
            if (strtolower($this->direction) === 'in') {
                if ($this->hasOfficialDue($this->agent)) {
                    $this->clearOfficialDues($this->agent, $this->amount);
                }
            }

            /* Create agent loan if needed. */
            if (strtolower($this->direction) === 'out') {
                if ($this->amount > $oldBalance) {
                    if ($oldBalance <= 0) {
                        $this->createAgentLoan($this->amount);
                    } else {
                        $this->createAgentLoan($this->amount - $oldBalance);
                    }
                }
            }
        });

        $this->emit('agentTransactionAdded');
    }

    public function hasOfficialDue($agent)
    {
        if ($agent->agentLoans) {
            return true;
        }

        if ($agent->medicalTests()
            ->whereIn('payment_status', ['pending', 'partially_paid',])
            ->get()) {
            return true;
        }

        return false;
    }

    public function clearOfficialDues($agent, $topup)
    {
        /* First try to clear loans. */
        $loans = $agent->agentLoans()
            ->whereIn('payment_status', ['pending', 'partially_paid',])
            ->get();

        foreach ($loans as $loan) {
            if ($topup > 0) {
                $topup = $loan->receivePayment($topup);
            } else {
                /* No more balance to pay. */
                break;
            }
        }

        /* Second try to clear pending bills. */
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

    public function createAgentLoan($amount)
    {
        $agentLoan = new AgentLoan;

        $agentLoan->agent_id = $this->agent->agent_id; 
        $agentLoan->amount = $amount; 
        $agentLoan->payment_status = 'pending'; 

        $agentLoan->save();
    }
}
