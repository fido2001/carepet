<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.index');
        }

        if ($request->user()->hasRole('petshop')) {
            return redirect()->route('petshop.index');
        }

        if ($request->user()->hasRole('petowner')) {
            return redirect()->route('petowner.index');
        }
    }
}
