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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('medical-test-create');
    }

    public function index()
    {
        return view('medical-test');
    }

    public function edit($id)
    {
        $medicalTest = MedicalTest::findOrFail($id);

        return view('medical-test-edit')
            ->with('medicalTest', $medicalTest);
    }
}
