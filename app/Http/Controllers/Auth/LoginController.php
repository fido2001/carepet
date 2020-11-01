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
            'username' => 'required|alpha_num|max:25',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username Tidak Boleh kosong',
            'username.max' => 'Maksimal 25 karakter',
            'password.required' => 'Password Tidak Boleh kosong',
        ]);
    }
}
