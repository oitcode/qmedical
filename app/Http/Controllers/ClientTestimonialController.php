<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientTestimonialController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->clientName;

        return ('<h1>You passed: ' . $name . '<h1>');
    }
}
