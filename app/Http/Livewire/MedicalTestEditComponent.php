<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Patient;
use App\Agent;
use App\MedicalTest;
use App\MedicalTestType;
//use App\MedicalTestBill;

class MedicalTestEditComponent extends Component
{
    public $agents;
    public $selectedAgent = null;
    public $selectedAgentId = null;

    public $patient;
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
    public $medicalTestStatus;
    public $medicalTestResult;
    public $medicalTestResultRemark;

    public $price;
    public $paymentStatus;

    public $agentCommission;
    public $agentCommissionStatus;

    public $medicalTestTypes = null;

    public $medicalTest;

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
        $this->medicalTestResult = $this->medicalTest->result;
        $this->medicalTestResultRemark = $this->medicalTest->result_remark;

        $this->selectedAgentId = $this->medicalTest->agent_id;

        $this->price = $this->medicalTest->price;
        $this->paymentStatus = $this->medicalTest->payment_status;

        $this->agentCommission = $this->medicalTest->agentCommission;
        $this->agentCommissionStatus = $this->medicalTest->agentCommissionStatus;
    }

    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();

        return view('livewire.medical-test-edit-component');
    }

    // public function selectAgent()
    // {
    //     $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);
    // }

    // public function undoAgentSelection()
    // {
    //     $this->selectedAgentId = null;
    //     $this->selectedAgent = null;
    // }

    public function update()
    {
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
        $medicalTest->result = $this->medicalTestResult;
        $medicalTest->result_remark = $this->medicalTestResultRemark;

        $medicalTest->patient_id = $patient->patient_id;
        //$medicalTest->agent_id = $this->selectedAgent->agent_id;



        $medicalTest->price = $this->price;
        $medicalTest->payment_status = $this->paymentStatus;

        $medicalTest->agentCommission = $this->agentCommission;
        $medicalTest->agentCommissionStatus = $this->agentCommissionStatus;

        $medicalTest->save();

        session()->flash('message', 'Medical Test Updated Successfully.');
    }
}
