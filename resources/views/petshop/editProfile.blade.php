@extends('layouts.master')

@section('title', 'Edit Profile | Care Pet')
@section('header', 'Edit Profile')
@section('content')
    {{-- <div class="col-12 col-md-12 col-lg-7">s --}}
        <div class="card">
            <form method="post" action="{{ route('edit.profile.petshop') }}" class="needs-validation" novalidate="">
                @csrf
                @method('PATCH')
                <div class="card-header">
                <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">                               
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Petshop</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required="">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Dokter</label>
                            <input type="text" class="form-control" name="nama_dokter" value="{{ $user->nama_dokter }}" required="">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Nomor HP</label>
                        <input type="tel" class="form-control" name="noHp" value="{{ $user->noHp }}">
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control summernote-simple">{{ $user->alamat }}</textarea>
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi
                        </div>
                    </div>
                    </div>
                    <a href="{{ route('edit.password.petshop') }}" class="text-danger">Ganti Password</a>
                </div>
                <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        
        {{-- </div> --}}
@endsection