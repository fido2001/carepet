<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetownerController extends Controller
{
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

    public function updateProfile(Request $request)
    {
        $this->_userValidation($request);
        $user = Auth::user();
        $attr = $request->all();
        $user->update($attr);
        return back();
    }

    public function editPassword()
    {
        return view('petowner.editPassword');
    }

    public function updatePassword()
    {
        request()->validate(
            [
                'old_password' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed', 'max:20'],
            ],
            [
                'old_password.required' => 'Kata sandi tidak boleh kosong',
                'password.required' => 'Kata sandi tidak boleh kosong',
                'password.min' => 'Minimal 8 Karakter',
                'password.max' => 'Maksimal 20 Karakter',
                'password.confirmed' => 'Masukkan konfirmasi password yang valid',
            ]
        );

        $currentPassword = auth()->user()->password;
        $oldPassword = request('old_password');

        if (Hash::check($oldPassword, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt(request('password'))
            ]);
            return back()->with('success', 'Ganti password berhasil.');
        } else {
            return back()->withErrors(['old_password' => 'Masukkan password anda yang sekarang.']);
        }
    }

    private function _userValidation(Request $request)
    {
        $validation = $request->validate(
            [
                'username' => ['required', 'alpha_num', 'max:15'],
                'noHp' => ['required', 'string', 'max:13', 'min:10', 'regex:/^(08)[0-9]*/'],
                'alamat' => ['required', 'max:50'],
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'max:30'],
            ],
            [
                'name.string' => 'Nama Lengkap Harus berupa huruf',
                'name.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'username.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'noHp.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'alamat.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'email.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'email.email' => 'Masukkan Email yang valid.',
                'name.max' => 'Maksimal 25 karakter',
                'noHp.regex' => 'Data tidak valid',
                'username.max' => 'Maksimal 15 karakter',
                'username.alpha_num' => 'Hanya bisa diisi dengan karakter alpha numeric',
            ]
        );
    }
}
