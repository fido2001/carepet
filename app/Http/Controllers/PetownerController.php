<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editProfile()
    {
        return view('petowner.editProfile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request, User $user)
    {
        $this->_userValidation($request);
        $attr = $request->all();
        $user->update($attr);
        return redirect('petowner');
    }

    private function _userValidation(Request $request)
    {
        $validation = $request->validate([
            'username' => ['required', 'alpha_num', 'max:25'],
            'noHp' => ['required', 'string', 'max:13', 'min:10'],
            'alamat' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
}
