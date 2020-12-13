<?php

namespace App\Http\Controllers;

use App\DataProduk;
use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetshopController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('petshop')) {
            $paket = Paket::where('user_id', auth()->user()->id)->get();
            $produk = DataProduk::where('user_id', auth()->user()->id)->get();
            $jml_paket = count($paket);
            $jml_produk = count($produk);
            return view('petshop.index', compact('jml_paket', 'jml_produk'));
        } else {
            return redirect('/');
        }
    }

    public function editProfile()
    {
        return view('petshop.editProfile', [
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
        return view('petshop.editPassword');
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
                'nama_dokter' => ['required', 'string', 'max:25'],
                'username' => ['required', 'alpha_num', 'max:15'],
                'noHp' => ['required', 'string', 'max:13', 'min:10', 'regex:/^(08)[0-9]*/'],
                'alamat' => ['required', 'max:50'],
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'max:30'],
            ],
            [
                'name.string' => 'Nama Lengkap Harus berupa huruf',
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'nama_dokter.required' => 'Data tidak boleh kosong, harap diisi',
                'username.required' => 'Data tidak boleh kosong, harap diisi',
                'noHp.required' => 'Data tidak boleh kosong, harap diisi',
                'alamat.required' => 'Data tidak boleh kosong, harap diisi',
                'email.required' => 'Data tidak boleh kosong, harap diisi',
                'email.email' => 'Masukkan Email yang valid.',
                'name.max' => 'Maksimal 25 karakter',
                'noHp.regex' => 'Data tidak valid',
                'username.max' => 'Maksimal 15 karakter',
                'username.alpha_num' => 'Hanya bisa diisi dengan karakter alpha numeric',
            ]
        );
    }
}
