<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'username' => ['required', 'alpha_num', 'max:25'],
                'noHp' => ['required', 'string', 'max:13', 'min:10'],
                'alamat' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'name.string' => 'Nama Lengkap Harus berupa huruf',
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'username.required' => 'Data tidak boleh kosong, harap diisi',
                'noHp.required' => 'Data tidak boleh kosong, harap diisi',
                'alamat.required' => 'Data tidak boleh kosong, harap diisi',
                'email.required' => 'Data tidak boleh kosong, harap diisi',
                'password.required' => 'Data tidak boleh kosong, harap diisi',
                'password.min' => 'Minimal 8 karakter',
                'password.confirmed' => 'Masukkan konfirmasi password yang valid',
                'email.email' => 'Masukkan Email yang valid.',
                'email.unique' => 'Email sudah digunakan, silakan ganti.',
                'username.max' => 'Maksimal 25 karakter',
                'username.alpha_num' => 'Hanya bisa diisi dengan karakter alpha numeric',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'noHp' => $data['noHp'],
            'alamat' => $data['alamat'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach(Role::where('name', 'petowner')->first());

        return $user;
    }
}
