<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Patient;
use App\Agent;
use App\MedicalTest;
use App\MedicalTestType;
use App\MedicalTestBill;
use App\AgentTransaction;

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
            'paymentStatus' => 'required',

            /* Agent Info */
            'selectedAgentId' => 'required|integer|exists:agent,agent_id',
            'agentCommission' => 'nullable|integer',
            'agentCommissionStatus' => 'required_with:agentCommission',
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
        $medicalTest->agent_id = $this->selectedAgent->agent_id;

        $medicalTest->price = $this->price;
        $medicalTest->payment_status = $this->paymentStatus;

        $medicalTest->agent_commission = $this->agentCommission;
        $medicalTest->agent_commission_status = $this->agentCommissionStatus;

        $medicalTest->save();

        /* Create agent_transaction if agent involved */
        if($this->selectedAgentId) {
            /* calculate amount to give/receive */
            $amount = 0;
            $direction = 'in';

            $amount = $this->agentCommission;
            if ($medicalTest->payment_status === 'Pending') {
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
}
