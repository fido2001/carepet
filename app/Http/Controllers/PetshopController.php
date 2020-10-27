<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetshopController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('petshop')) {
            return view('petshop.index');
        } else {
            return redirect('/');
        }
    }
}
