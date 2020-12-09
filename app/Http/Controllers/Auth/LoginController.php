<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_num|max:15',
            'password' => 'required|string|max:20',
        ], [
            'username.required' => 'Username Tidak Boleh kosong',
            'username.max' => 'Maksimal 15 karakter',
            'password.required' => 'Password Tidak Boleh kosong',
            'password.max' => 'Maksimal 20 karakter',
        ]);
    }
}
