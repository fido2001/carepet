@extends('layouts.master')

@section('header', 'Edit User')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">                               
                <div class="form-group col-md-6 col-12">
                    <label>Nama Petshop</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Phone</label>
                    <input type="tel" class="form-control" name="noHp" value="{{ $user->noHp }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control summernote-simple" disabled>{{ $user->alamat }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
        <a href="{{ route('show.users-management') }}" class="btn btn-warning">Back</a>
        </div>
    </div>
@endsection