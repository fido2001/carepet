@extends('layouts.master')

@section('content')
<div class="section-body">
    <h2 class="section-title">Tambah Data Pengajuan Penarikan Saldo</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="text-center">
                    <span class="d-block">Saldo saat ini</span>
                    <span style="font-size: 2em;"><b>Rp. {{ $saldo }}</b></span>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.withdrawal.petshop') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_petshop" value="{{ auth()->user()->id }}">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nominal Penarikan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" min="25000" step="100" class="form-control @error('jml_penarikan') is-invalid @enderror" name="jml_penarikan" value="{{ old('jml_penarikan') }}">
                                @error('jml_penarikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bank Penerima</label>
                            <div class="col-sm-12 col-md-7">
                                <select name="bank" class="form-control @error('bank') is-invalid @enderror" id="bank">
                                    <option hidden selected value>Pilih Bank Penerima</option>
                                    <option value="BCA">BCA</option>
                                    <option value="BNI">BNI</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="BRI">BRI</option>
                                </select>
                                @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Rekening</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening" value="{{ old('no_rekening') }}">
                                @error('no_rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Atas Nama</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('nama_rekening') is-invalid @enderror" name="nama_rekening" value="{{ old('nama_rekening') }}">
                                @error('nama_rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Ajukan</button>
                                <a href="{{ route('index.withdrawal.petshop') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection