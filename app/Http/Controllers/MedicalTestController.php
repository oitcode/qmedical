<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MedicalTest;

class MedicalTestController extends Controller
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

    public function index()
    {
        return view('medical-test');
    }

    public function create()
    {
        return view('medical-test-create');
    }

    public function edit($id)
    {
        $medicalTest = MedicalTest::findOrFail($id);

        return view('medical-test-create')
            ->with('medicalTest', $medicalTest)
            ->with('edit', true);
    }
}
