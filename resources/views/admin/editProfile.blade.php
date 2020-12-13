@extends('layouts.master')

@section('title', 'Edit Profil | Care Pet')
@section('header', 'Edit Profil')
@section('content')
    <div class="card">
        <form method="post" action="{{ route('update.users-management', $user) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <div class="card-header">
            <h4>Edit Profil</h4>
            </div>
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Nomor HP</label>
                        <input type="tel" class="form-control @error('noHp') is-invalid @enderror" name="noHp" value="{{ $user->noHp }}">
                        @error('noHp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control summernote-simple @error('alamat') is-invalid @enderror">{{ $user->alamat }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <a href="{{ route('edit.password.admin') }}" class="text-danger">Ganti Password</a>
            </div>
            <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection