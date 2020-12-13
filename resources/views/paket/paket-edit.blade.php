@extends('layouts.master')

@section('title', 'Service Packages | CarePet')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
<div class="section-body">
    <h2 class="section-title">Edit Data Paket</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('update.paket.petshop', $paket) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $paket->id }}">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Paket</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" name="nama_paket" value="{{ $paket->nama_paket }}">
                                @error('nama_paket')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" min="1000" step="100" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $paket->harga }}">
                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple @error('keterangan') is-invalid @enderror" name="keterangan">{{ $paket->keterangan }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-7">
                                <select name="status" id="" class="form-control @error('status') is-invalid @enderror">
                                    <option disabled selected>Pilih Salah Satu</option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('index.paket.petshop') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush