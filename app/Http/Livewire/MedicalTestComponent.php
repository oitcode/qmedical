<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\MedicalTest;
use App\Agent;

class MedicalTestComponent extends Component
{
    public $medicalTests;

    public $createMode = false;
    public $displayMode = false;
    public $displayedMedicalTest = null;
    public $updateMode = false;
    public $updatingMedicalTest = null;
    public $medicalTestTypeCreateMode = false;
    public $deleteMode = false;
    public $deletingMedicalTest = null;

    public $patientSearchName = "";

    public $agentDisplayMode = false;
    public $displayingAgent;


    protected $listeners = [
        'destroyCreate' => 'exitCreateMode',
        'createCancelled' => 'exitCreateMode',
        'medicalTestAdded' => 'finishCreate',
        'displayMedicalTest' => 'displaySingleMedicalTest',
        'destroyDisplay' => 'exitDisplayMode',
        'displayCancelled' => 'exitDisplayMode',
        'createCancel' => 'exitCreateMode',
        'confirmDeleteMedicalTest',
        'deleteMedicalTest',
        'updateMedicalTest',
        'destroyMedicalTestUpdate' => 'exitUpdateMode',
        'medicalTestUpdated' => 'refreshList',
        'destroyMedicalTestTypeCreate' => 'exitMedicalTestTypeCreateMode',
        'mtc_displayAgent' => 'displayAgent',
        'destroyAgentDisplay' => 'exitAgentDisplayMode',
    ];

    public function render()
    {
        $this->medicalTests = MedicalTest::all();

        return view('livewire.medical-test-component');
    }

    public function create()
    {
        $this->createMode = true;
    }

    public function finishCreate()
    {
        $this->emit('dataAdded');
    }

    public function refreshList()
    {
        $this->emit('refreshMedicalTestList');
    }

    public function exitCreateMode()
    {
        $this->createMode = false;
    }

    public function enterDisplayMode()
    {
        $this->displayMode = true;
    }

    public function exitDisplayMode()
    {
        $this->displayedMedicalTest = null;
        $this->displayMode = false;
    }

    public function displaySingleMedicalTest(MedicalTest $medicalTest)
    {
        $this->enterDisplayMode();
        $this->displayedMedicalTest = null;
        $this->displayedMedicalTest = $medicalTest;
        $this->render();
    }

    public function deleteMedicalTest($id)
    {
        $medicalTest = MedicalTest::findOrFail($id);

        DB::beginTransaction();

        try {
            /* Delete agent transactions if any */
            /* Store patient info. Needed to delete it later if needed. */
            $patient = $medicalTest->patient;

            if ($medicalTest->agentTransaction) {
              $medicalTest->agentTransaction->delete();
            }

            /* Delete payments if any */
            if ($medicalTest->payments) {
              foreach ($medicalTest->payments as $payment) {
                  /* Delete triggered payment if necessary */
                  if ($payment->triggeredPayments) {
                      foreach ($payment->triggeredPayments as $triggeredPayment) {
                          $triggeredPayment->deleteAndUpdatePaymentStatus();
                      }
                  }
              }
              $medicalTest->payments()->delete();
            }

            $medicalTest->delete();

            /* Delete patient if necessary */
            if (count($patient->medicalTests) === 0) {
                $patient->delete();
            }
        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        $this->exitDeleteMode();
        $this->emit('updateList');
    }

    public function updateMedicalTest(MedicalTest $medicalTest)
    {
        $this->updatingMedicalTest = $medicalTest;
        $this->enterUpdateMode();
    }

    public function enterUpdateMode()
    {
        $this->updateMode = true;
    }

    public function exitUpdateMode()
    {
        $this->updatingMedicalTest = null;
        $this->updateMode = false;
    }

    public function search()
    {
        $this->emit('searchMedicalTestByPatientName', $this->patientSearchName);
    }

    public function enterMedicalTestTypeCreateMode()
    {
        $this->medicalTestTypeCreateMode = true;
    }

    public function exitMedicalTestTypeCreateMode()
    {
        $this->medicalTestTypeCreateMode = false;
    }

    public function confirmDeleteMedicalTest($id)
    {
        $this->deleteMode = true;
        $this->deletingMedicalTest = MedicalTest::findOrFail($id);
    }

    public function exitDeleteMode()
    {
        $this->deletingMedicalTest = null;
        $this->deleteMode = false;
    }

    public function foo()
    {
        $i = 1;
        $this->exitDeleteMode();
    }

    public function displayAgent($agentId)
    {
        $this->displayingAgent = Agent::findOrFail($agentId);
        $this->enterAgentDisplayMode();
    }

    public function enterAgentDisplayMode()
    {
        $this->agentDisplayMode = true;
    }

    public function exitAgentDisplayMode()
    {
        $this->agentDisplayMode = false;
        $this->displayingAgent = null;
    }
}
