<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Agent;

class AgentController extends Controller
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
    public function index()
    {
        return view('agent');
    }

    /**
     * Agent detail page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $agent = Agent::findOrFail($id);

        return view('agent-show')
            ->with('agent', $agent);
    }
}
