<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\MedicalTest;
use App\MedicalTestType;
use App\Agent;

class MedicalTestUpdate extends Component
{
    public $medicalTest;

    public $agents;
    public $selectedAgent = null;
    public $selectedAgentId = null;

    public $patientId;
    public $patientName;
    public $patientSex;
    public $patientDob;

    public $patientAddress;
    public $patientContactNumber;
    public $patientEmail;

    public $patientPassportNumber;
    public $patientPassportExpiryDate;
    public $patientPassportIssuePlace;
    public $patientNationality;

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

    public function mount()
    {
        $patient = $this->medicalTest->patient;

        $this->patientName = $patient->name;
        $this->patientSex = $patient->sex;
        $this->patientDob = $patient->dob;

        $this->patientAddress = $patient->address;
        $this->patientContactNumber = $patient->contact_number;
        $this->patientEmail = $patient->email;

        $this->patientPassportNumber = $patient->passport_number;
        $this->patientPassportExpiryDate = $patient->passport_expiry_date;
        $this->patientPassportIssuePlace = $patient->passport_issue_place;
        $this->patientNationality = $patient->nationality;

        $this->medicalTestDate = $this->medicalTest->date;
        $this->medicalTestTypeId = $this->medicalTest->medical_test_type_id;
        $this->medicalTestStatus = $this->medicalTest->status;
        $this->result = $this->medicalTest->result;
        $this->resultRemark = $this->medicalTest->result_remark;

        $this->selectedAgentId = $this->medicalTest->agent_id;
        $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);

        $this->price = $this->medicalTest->price;
        $this->paymentStatus = $this->medicalTest->payment_status;

        $this->agentCommission = $this->medicalTest->agent_commission;
        $this->agentCommissionStatus = $this->medicalTest->agent_commission_status;
    }

    public function render()
    {
        $this->medicalTestTypes = MedicalTestType::all();
        $this->agents = Agent::all();

        return view('livewire.medical-test-update');
    }

    public function resetInputFields()
    {
        //
    }

    public function update()
    {
        // $validatedData = $this->validate([
        //     'name' => 'required',
        //     'sex' => 'required',
        //     'email' => 'required',
        //     'contact_number' => 'required',
        //     'comment' => 'nullable',
        // ]);


        $patient = $this->medicalTest->patient;

        $patient->name = $this->patientName;
        $patient->sex = $this->patientSex;
        $patient->dob = $this->patientDob;

        $patient->address = $this->patientAddress;
        $patient->contact_number = $this->patientContactNumber;
        $patient->email = $this->patientEmail;

        $patient->passport_number = $this->patientPassportNumber;
        $patient->passport_expiry_date = $this->patientPassportExpiryDate;
        $patient->passport_issue_place = $this->patientPassportIssuePlace;
        $patient->nationality = $this->patientNationality;

        $patient->save();

        $medicalTest = $this->medicalTest;

        $medicalTest->date = $this->medicalTestDate;
        $medicalTest->medical_test_type_id = $this->medicalTestTypeId;
        $medicalTest->status = $this->medicalTestStatus;

        $medicalTest->patient_id = $patient->patient_id;
        $medicalTest->agent_id = $this->selectedAgent->agent_id;

        $medicalTest->price = $this->price;
        $medicalTest->payment_status = $this->paymentStatus;

        $medicalTest->agent_commission = $this->agentCommission;
        $medicalTest->agent_commission_status = $this->agentCommissionStatus;

        $medicalTest->result = $this->result;
        $medicalTest->result_remark = $this->resultRemark;

        $medicalTest->save();

        $this->emit('toggleMedicalTestUpdateModal');
        $this->emit('medicalTestUpdated');
    }

    public function selectAgent()
    {
        $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);

        $this->dispatchBrowserEvent('agentSelected');
    }
}
