@extends('layouts.master')

@section('header', 'Edit User')
@section('content')
    <div class="card">
        <form method="post" action="{{ route('update.users-management', $user) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Petshop</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi.
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Dokter</label>
                        <input type="text" class="form-control" name="nama_dokter" value="{{ $user->nama_dokter }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi.
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required="">
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi.
                    </div>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Nomor HP</label>
                    <input type="tel" class="form-control" name="noHp" value="{{ $user->noHp }}">
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi.
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control summernote-simple">{{ $user->alamat }}</textarea>
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi.
                    </div>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" required="">
                    <div class="invalid-feedback">
                        Data tidak boleh kosong, harap diisi.
                    </div>
                </div>
                </div>
            </div>
            <div class="card-footer text-right">
            {{-- <a href="{{ route('show.users-management') }}" class="btn btn-warning">Batal</a> --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection