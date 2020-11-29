<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Patient;
use App\Agent;
use App\MedicalTest;
use App\MedicalTestType;
use App\MedicalTestBill;

class MedicalTestCreateComponent extends Component
{
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

    public $medicalTestBillPrice;
    public $medicalTestBillPaymentStatus;

    public $medicalTestTypes = null;

    public function render()
    {
        $this->agents = Agent::all();
        $this->medicalTestTypes = MedicalTestType::all();

        return view('livewire.medical-test-create-component');
    }

    public function selectAgent()
    {
        $this->selectedAgent = Agent::findOrFail($this->selectedAgentId);
    }

    public function undoAgentSelection()
    {
        $this->selectedAgentId = null;
        $this->selectedAgent = null;
    }

    public function store()
    {
        $patient = new Patient;

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


        $medicalTest = new MedicalTest;

        $medicalTest->date = $this->medicalTestDate;
        $medicalTest->medical_test_type_id = $this->medicalTestTypeId;
        $medicalTest->status = $this->medicalTestStatus;

        $medicalTest->patient_id = $patient->patient_id;
        $medicalTest->agent_id = $this->selectedAgent->agent_id;

        $medicalTest->save();


        $medicalTestBill = new MedicalTestBill;

        $medicalTestBill->medical_test_id = $medicalTest->medical_test_id;
        $medicalTestBill->amount = $this->medicalTestBillPrice;
        $medicalTestBill->payment_status = $this->medicalTestBillPaymentStatus;

        $medicalTestBill->save();

        session()->flash('message', 'Medical Test Created Successfully.');
    }
}
