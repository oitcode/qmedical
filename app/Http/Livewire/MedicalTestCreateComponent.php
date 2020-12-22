<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Patient;
use App\Agent;
use App\MedicalTest;
use App\MedicalTestType;
use App\MedicalTestBill;
use App\AgentTransaction;
use App\Payment;
use App\AgentCommission;

class MedicalTestCreateComponent extends Component
{
    public $medicalTest;

    public $agents;
    public $selectedAgent = null;
    public $selectedAgentId = null;

    public $patientId;
    public $patientName;
    public $patientSex;
    public $patientDob;

    public $patientAddress = "";
    public $patientContactNumber = "";
    public $patientEmail = "";

    public $patientPassportNumber = "";
    public $patientPassportExpiryDate = "";
    public $patientPassportIssuePlace = "";
    public $patientNationality = "";

    public $medicalTestDate;
    public $medicalTestTypeId;
    public $medicalTestStatus = 'Waiting';

    public $price;
    public $paymentStatus;

    public $agentCommission;
    public $agentCommissionStatus;

    public $result;
    public $resultRemark;

    public $medicalTestTypes = null;

    public $editMode = false;

    public $agentFlag = 'no';
    public $creditFlag = 'no';

    public $payBy;

    public function mount()
    {
        if ($this->editMode) {
            $this->enterEditMode();
            $this->edit();
        }
    }

    public function enterEditMode()
    {
        $this->editMode = true;
    }


    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();

        return view('livewire.medical-test-create-component');
    }

    public function selectAgent()
    {
        $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);

        $this->dispatchBrowserEvent('agentSelected');
    }

    public function undoAgentSelection()
    {
        $this->selectedAgentId = null;
        $this->selectedAgent = null;
    }

    public function store()
    {
        /* For payment */
        $payment = null;

        /* Validate form data */

        $validatedData = $this->validate([

            /* Medical test info */
            'medicalTestDate' => 'required|date',
            'medicalTestTypeId' => 'required|integer|exists:medical_test_type,medical_test_type_id',


            /* Patient Info */
            'patientName' => 'required',
            'patientSex' => 'required',
            'patientDob' => 'required|date',

            'patientAddress' => 'nullable',
            'patientContactNumber' => 'nullable',
            'patientEmail' => 'nullable|email',

            /* Patient Passport Info */
            'patientPassportNumber' => 'nullable',
            'patientPassportExpiryDate' => 'nullable|date',
            'patientPassportIssuePlace' => 'nullable',

            /* Billing Info */
            'price' => 'required|integer',
            'creditFlag' => 'required|string',

            /* Agent Info */
            'selectedAgentId' => 'nullable|integer|exists:agent,agent_id',
            'agentCommission' => 'nullable|integer',

            /* PayBy */
            'payBy' => 'required_if:agentFlag,Yes',
        ]);

        /* Just in case this is needed. */
        $partialPayment = null;

        /* In case where commission received will help clear previous dues. */
        $balanceTopup = false;
        $topupAmount = 0;

        $patient = new Patient;

        $patient->name = $this->patientName;
        $patient->sex = $this->patientSex;
        $patient->dob = $this->patientDob;

        if($this->patientAddress) {
            $patient->address = $this->patientAddress;
        }

        if($this->patientContactNumber) {
            $patient->contact_number = $this->patientContactNumber;
        }

        if($this->patientEmail) {
            $patient->email = $this->patientEmail;
        }

        if($this->patientPassportNumber) {
            $patient->passport_number = $this->patientPassportNumber;
        }

        if($this->patientPassportExpiryDate) {
            $patient->passport_expiry_date = $this->patientPassportExpiryDate;
        }

        if($this->patientPassportIssuePlace) {
            $patient->passport_issue_place = $this->patientPassportIssuePlace;
        }

        if($this->patientNationality) {
            $patient->nationality = $this->patientNationality;
        }


        $patient->save();


        $medicalTest = new MedicalTest;

        $medicalTest->date = $this->medicalTestDate;
        $medicalTest->medical_test_type_id = $this->medicalTestTypeId;
        $medicalTest->status = $this->medicalTestStatus;

        $medicalTest->patient_id = $patient->patient_id;
        if ($this->selectedAgent) {
            $medicalTest->agent_id = $this->selectedAgent->agent_id;
        }

        $medicalTest->price = $this->price;
        $medicalTest->payment_status = $this->paymentStatus;
        $medicalTest->pay_by = $this->payBy;


        if (strtolower($this->agentFlag) === 'yes' && $this->selectedAgent) {

            /*
             * Agent Case
             */

            $medicalTest->agent_commission = $this->agentCommission;

            $transactionAmount = $this->agentCommission;

            if (strtolower($this->payBy) === 'agent') {
                $transactionAmount -= $this->price;
                if ($transactionAmount < 0) {
                    $transactionAmount *= -1;

                    if ($transactionAmount <= $this->getAgentBalance($this->selectedAgent)) {
                        $medicalTest->payment_status = 'paid';

                        /* Create a payment_record */
                        $payment = new Payment;
                        $payment->amount = $this->price - $this->agentCommission;
                        $payment->type = 'cash';

                    } else if ($transactionAmount > $this->getAgentBalance($this->selectedAgent)
                               && $this->getAgentBalance($this->selectedAgent) > 0) {

                        $medicalTest->payment_status = 'partially_paid';

                        /* Create payment */
                        $payment = new Payment;
                        $payment->amount = $this->getAgentBalance($this->selectedAgent);
                        $payment->type = 'cash';

                        /* Store credit info */
                        $medicalTest->credit_amount = $this->price - $this->agent_commission - $payment->amount;
                    } else {
                        $medicalTest->payment_status = 'pending';

                        /* Store credit info */
                        $medicalTest->credit_amount = $this->price - $this->agent_commission;
                    }
                }
            } else if (strtolower($this->payBy) === 'self') {

                /*
                 * There is agent but pay by self
                 */

                $medicalTest->pay_by = 'self';
                if ($this->creditFlag === 'yes') {
                    $medicalTest->payment_status = 'pending';
                    /* TODO: But client says this will never be true. */
                } else {
                    $medicalTest->payment_status = 'paid';

                    /*  Create payment_record */
                    $payment = new Payment;
                    $payment->amount = $this->price - $this->agentCommission;
                    $payment->type = 'cash';
                }
            } else {
                // TODO: Cancel the creation. Something is wrong!
            }


        } else {

            /*
             * No Agent Case
             */

            $medicalTest->pay_by = 'self';

            if (strtolower($this->creditFlag) === 'yes') {
                $medicalTest->payment_status = 'pending';
                /* TODO: But client says this will never be true. */
            } else {
                $medicalTest->payment_status = 'paid';
                /* Create payment record */
                $payment = new Payment;
                $payment->amount = $this->price;
                $payment->type = 'cash';
            }
        }

        $medicalTest->save();

        /* Save payment record. */
        if ($payment) {
            $payment->medical_test_id = $medicalTest->medical_test_id;
            $payment->save();
        }

        /* Create agent_transaction if agent involved */
        if($this->selectedAgent) {
            /* calculate amount to give/receive */
            $amount = 0;
            $direction = 'in';

            $amount = $this->agentCommission;
            if (strtolower($this->payBy) === 'agent') {
                $amount -= $this->price;
            }

            if ($amount < 0) {
                $direction = 'out';
                $amount *= -1;
            }

            
            $agentTransaction = new AgentTransaction;

            $agentTransaction->medical_test_id = $medicalTest->medical_test_id;
            $agentTransaction->agent_id = $this->selectedAgentId;
            $agentTransaction->amount = $amount;
            $agentTransaction->direction = $direction;
            $agentTransaction->comment = 'medical test';

            $agentTransaction->save();

            if ($agentTransaction->direction === 'in') {
                $balanceTopup = true;
                $topupAmount = $agentTransaction->amount;
            }
        }

        /* Clear any pending payment if possible */
        if ($balanceTopup === true) {
            if ($this->hasOfficialDue($this->selectedAgent)) {
                $this->clearOfficialDues($this->selectedAgent, $topupAmount);
            }
        }


        $this->emitUp('medicalTestAdded');
        $this->emit('toggleMedicalTestCreateModal');
    }


    public function cancelCreate()
    {
        $this->emit('createCancelled');
    }

    public function showModal()
    {
        $this->emit('show');
    }

    public function getAgentBalance(Agent $agent)
    {
        $transactions = $agent->agentTransactions;

        $total = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->direction === 'in') {
                $total += $transaction->amount;
            } else {
                $total -= $transaction->amount;
            }
        }

        return $total;
    }

    public function hasOfficialDue(Agent $agent)
    {
        if ($agent->medicalTests()
            ->whereIn('payment_status', ['pending', 'partially_paid',])
            ->get()) {
            return true;
        }

        return false;
    }

    public function clearOfficialDues(Agent $agent, $topup)
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

    public function payDue(MedicalTest $medicalTest, $topup)
    {
        if ($topup >= $this->getDueAmount($medicalTest)) {
            /* Create payment. */
            $payment = new Payment;

            $payment->medical_test_id = $medicalTest->medical_test_id;
            $payment->amount = $this->getDueAmount($medicalTest);
            $payment->type = 'due';
            $payment->save();

            $medicalTest->payment_status = 'paid';
            $medicalTest->save();

            $topup -= $this->getDueAmount($medicalTest);
        } else {
            /* Not enough topup to pay fully. Make a partial payment. */

            $payment = new Payment;
            $payment->medical_test_id = $medicalTest->medical_test_id;
            $payment->amount = $topup;
            $payment->type = 'due';
            $payment->save();

            $medicalTest->payment_status = 'partially_paid';
            $medicalTest->save();

            $topup = 0;
        }

        return $topup;
    }

    public function getDueAmount(MedicalTest $medicalTest)
    {
        $dueAmount = $medicalTest->price - $medicalTest->agent_commission;

        if ($medicalTest->payments !== null) {
            $dueAmount -= $this->getPaidAmount($medicalTest);
        }

        return $dueAmount;
    }

    public function getPaidAmount(MedicalTest $medicalTest)
    {
        $amount = 0;

        foreach ($medicalTest->payments as $payment) {
            $amount += $payment->amount;
        }

        return $amount;
    }

    public function storeClassic()
    {
        /* Validate form data */

        $validatedData = $this->validate([

            /* Medical test info */
            'medicalTestDate' => 'required|date',
            'medicalTestTypeId' => 'required|integer|exists:medical_test_type,medical_test_type_id',


            /* Patient Info */
            'patientName' => 'required',
            'patientSex' => 'required',
            'patientDob' => 'required|date',

            'patientAddress' => 'nullable',
            'patientContactNumber' => 'nullable',
            'patientEmail' => 'nullable|email',

            /* Patient Passport Info */
            'patientPassportNumber' => 'nullable',
            'patientPassportExpiryDate' => 'nullable|date',
            'patientPassportIssuePlace' => 'nullable',

            /* Billing Info */
            'price' => 'required|integer',
            'creditFlag' => 'required|string',

            /* Agent Info */
            'selectedAgentId' => 'nullable|integer|exists:agent,agent_id',
            'agentCommission' => 'nullable|integer',

            /* PayBy */
            'payBy' => 'required_if:agentFlag,Yes',
        ]);


        $patient = new Patient;

        $patient->name = $this->patientName;
        $patient->sex = $this->patientSex;
        $patient->dob = $this->patientDob;

        if($this->patientAddress) {
            $patient->address = $this->patientAddress;
        }

        if($this->patientContactNumber) {
            $patient->contact_number = $this->patientContactNumber;
        }

        if($this->patientEmail) {
            $patient->email = $this->patientEmail;
        }

        if($this->patientPassportNumber) {
            $patient->passport_number = $this->patientPassportNumber;
        }

        if($this->patientPassportExpiryDate) {
            $patient->passport_expiry_date = $this->patientPassportExpiryDate;
        }

        if($this->patientPassportIssuePlace) {
            $patient->passport_issue_place = $this->patientPassportIssuePlace;
        }

        if($this->patientNationality) {
            $patient->nationality = $this->patientNationality;
        }


        $patient->save();


        $medicalTest = new MedicalTest;

        $medicalTest->date = $this->medicalTestDate;
        $medicalTest->medical_test_type_id = $this->medicalTestTypeId;
        $medicalTest->status = $this->medicalTestStatus;

        $medicalTest->patient_id = $patient->patient_id;
        if ($this->selectedAgent) {
            $medicalTest->agent_id = $this->selectedAgent->agent_id;
        }

        $medicalTest->price = $this->price;
        $medicalTest->payment_status = $this->paymentStatus;
        $medicalTest->pay_by = $this->payBy;

        if (strtolower($this->agentFlag) === 'yes' && $this->selectedAgent) {

            /*
             * Agent Case
             */

            $medicalTest->agent_commission = $this->agentCommission;

            if (strtolower($this->payBy) === 'agent') {
                $medicalTest->pay_by = 'agent';
                $medicalTest->payment_status = 'pending';
            } else if (strtolower($this->payBy) === 'self') {

                /*
                 * There is agent but pay by self
                 */

                $medicalTest->pay_by = 'self';
                $medicalTest->payment_status = 'paid';
            } else {
                // TODO: Cancel the creation. Something is wrong!
            }


        } else {

            /*
             * No Agent Case
             */

            $medicalTest->pay_by = 'self';
            $medicalTest->payment_status = 'paid';
        }

        $medicalTest->save();

        /* Create agent_commission if needed */
        if($this->selectedAgent && strtolower($this->payBy) === 'self') {
            $amount = $this->agentCommission;

            /* TODO: Should increase commission instead.*/
            $agentCommission = new AgentCommission;

            $agentCommission->medical_test_id = $medicalTest->medical_test_id;
            $agentCommission->agent_id = $this->selectedAgent->agent_id;
            $agentCommission->amount = $amount;
            $agentCommission->direction = 'in';
            $agentCommission->comment = 'medical test';

            $agentCommission->save();
        }


        $this->emitUp('medicalTestAdded');
        $this->emit('toggleMedicalTestCreateModal');
    }
}
