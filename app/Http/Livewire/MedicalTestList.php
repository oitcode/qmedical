<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\MedicalTest;
use App\Agent;

class MedicalTestList extends Component
{
    public $createMode = false;

    public $medicalTests = null;

    /* Search items */
    public $searchData = [
        'id' => null,
        'patientName' => null,
        'startDate' => null,
        'endDate' => null,
        'agentId' => null,
        'medicalTestTypeId' => null,
        'paymentStatus' => null,
    ];

    public $searchToolBoxShow = false;

    public $agents = null;

    protected $listeners = [
        'dataAdded' => 'mount',
        'updateList' => 'mount',
        'refreshMedicalTestList' => 'mount',
        'searchMedicalTestByPatientName' => 'searchByPatientName',
        'medicalTestStatusUpdated' => 'mount',
        'agentTransactionAdded' => 'render',
    ];

    public function mount()
    {
        $this->medicalTests = MedicalTest::orderBy('date', 'desc')
            ->orderBy('medical_test_id', 'desc')
            ->limit(5)
            ->get();

        $this->agents = Agent::all();
    }

    public function render()
    {
        return view('livewire.medical-test-list');
    }

    public function searchByPatientName($patientSearchName)
    {
        $searchName = $patientSearchName;

        $this->medicalTests = MedicalTest::whereHas('patient',
        function ($query) use ($searchName) {
            $query->where('name', 'like', '%' . $searchName .'%');
        })
        ->get();
    }

    public function search()
    {
        /* Result */
        $medicalTests = new MedicalTest;

        /* Retreive all records if empty search */
        $emptySearch = true;
        foreach ($this->searchData as $key => $value) {
            if ($key != 'endDate' && $value !== null && $value != '') {
              $emptySearch = false;
              break;
            }
        }

        if ($emptySearch) {
            $this->medicalTests = $medicalTests->orderBy('date', 'desc')
            ->orderBy('medical_test_id', 'desc')
            ->get();

            return;
        } 

        /* Apply search filter */

        /* Filter by patient name */
        if ($this->searchData['patientName']) {
            $searchName = $this->searchData['patientName'];
            $medicalTests = MedicalTest::whereHas('patient',
            function ($query) use ($searchName) {
                $query->where('name', 'like', '%' . $searchName .'%');
            });
        }

        /* Filter by agent */
        if ($this->searchData['agentId'] && $this->searchData['agentId'] != '---') {
            $medicalTests = $medicalTests->where('agent_id', $this->searchData['agentId']);
        }

        /* Medical test id */
        if ($this->searchData['id']) {
            $medicalTests = $medicalTests->where('medical_test_id', $this->searchData['id']);
        }

        /* Single day */
        if ($this->searchData['startDate'] && !$this->searchData['endDate']) {
            $medicalTests = $medicalTests->whereDate('date', '=', $this->searchData['startDate']);
        }

        /* Range of days */
        if ($this->searchData['startDate'] && $this->searchData['endDate']) {
            $medicalTests = $medicalTests->whereDate('date', '>=', $this->searchData['startDate']);
            $medicalTests = $medicalTests->whereDate('date', '<=', $this->searchData['endDate']);
        }

        /* Payment Status */
        if ($this->searchData['paymentStatus'] && $this->searchData['paymentStatus'] != '---') {
            $medicalTests = $medicalTests->where('payment_status', $this->searchData['paymentStatus']);
        }

        $this->medicalTests = $medicalTests
            ->orderBy('date', 'desc')
            ->orderBy('medical_test_id', 'desc')
            ->get();
    }

    public function toggleSearchToolBox()
    {
        $this->searchToolBoxShow = !$this->searchToolBoxShow;
    }
}
