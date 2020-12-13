@extends('layouts.master-user')

@section('title', 'Detail Pet Shop | CarePet')
@section('header', 'Detail Pet Shop')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">                               
                <div class="form-group col-md-6 col-12">
                    <label>Nama Pet Shop</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control" name="noHp" value="{{ $user->noHp }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control summernote-simple" disabled>{{ $user->alamat }}</textarea>
                </div>
                @if ($user->nama_dokter != null)
                <div class="form-group col-md-6 col-12">
                    <label>Nama Dokter</label>
                    <input type="text" class="form-control" name="noHp" value="{{ $user->nama_dokter }}" disabled>
                </div>
                @endif
            </div>
        </div>
        <div class="card-footer text-right">
        <a href="{{ route('show.petshop') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
@endsection