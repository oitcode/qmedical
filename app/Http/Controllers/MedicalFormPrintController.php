<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MedicalTest;

class MedicalFormPrintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $medicalTest = MedicalTest::findOrFail($id);

        return view('medical-form-print')
            ->with('medicalTest', $medicalTest);
    }
}
