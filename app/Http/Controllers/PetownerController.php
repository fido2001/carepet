<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetownerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('petowner')) {
            return view('petowner.index');
        } else {
            return redirect('/');
        }
    }
}
