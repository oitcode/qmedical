<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\AgentCommission;

class MedicalTestAgentCommissionComponent extends Component
{
    public $medicalTestBill;
    public $medicalTestAgentCommission;
    public $msg;

    public $agentCommissionAmount;
    public $agentCommissionStatus;

    public function render()
    {
        return view('livewire.medical-test-agent-commission-component');
    }

    public function create()
    {
        //$this->agentCommissionAmount = 100;
        // $this->agentCommissionStatus = 'done';
        // $this->msg="Foo";
        $agentCommission = new AgentCommission;

        $agentCommission->amount = $this->agentCommissionAmount;
        $agentCommission->payment_status = $this->agentCommissionStatus;
        $agentCommission->medical_test_bill_id = $this->medicalTestBill->medical_test_bill_id;

        $agentCommission->save();
        session()->flash('message', 'Commission Updated Successfully.');
    }
}
