<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            return view('admin.index');
        } else {
            return redirect('/');
        }
    }

    public function editProfile()
    {
        return view('admin.editProfile', [
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

    public function showUsersManagement()
    {
        return view('admin.usersManagement', [
            'users' => User::all(),
            'roles' => Role::all(),
        ]);
    }

    public function editUsersManagement(User $user)
    {
        return view('admin.editUsers', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function updateUsersManagement(Request $request, $id)
    {
        $this->_userValidation($request);
        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'noHp' => $request->noHp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back();
    }

    public function destroyUsersManagement($id)
    {
        User::destroy($id);
        return redirect()->back();
    }

    public function storeDataPetshop(Request $request)
    {
        request()->validate([
            'username' => ['required', 'alpha_num', 'max:25'],
            'noHp' => ['required', 'string', 'max:13', 'min:10'],
            'alamat' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'noHp' => $request->input('noHp'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->roles()->attach(Role::where('name', 'petshop')->first());

        return redirect()->back();
    }

    public function editPassword()
    {
        return view('petshop.editPassword');
    }

    public function updatePassword()
    {
        request()->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

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
        $validation = $request->validate([
            'username' => ['required', 'alpha_num', 'max:25'],
            'noHp' => ['required', 'string', 'max:13', 'min:10'],
            'alamat' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }
}
