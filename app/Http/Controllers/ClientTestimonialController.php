<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientTestimonials;

class ClientTestimonialController extends Controller
{
    public function store(Request $request)
    {
        $name = $request->clientName;



        $ct = new ClientTestimonials;

        $ct->client_name = $name;
        $ct->save();

        return redirect('/aboutus');
    }
}
