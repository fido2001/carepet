@extends('layouts.master')

@section('title', 'Penarikan Dana | CarePet')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('content')
<div class="section-body">
    <h2 class="section-title">Detail Data Pengajuan Penarikan Saldo</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nominal Penarikan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('jml_penarikan') is-invalid @enderror" name="jml_penarikan" value="Rp. {{ $withdrawal->jml_penarikan }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bank Penerima</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('jml_penarikan') is-invalid @enderror" name="jml_penarikan" value="Bank {{ $withdrawal->bank }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Rekening</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening" value="{{ $withdrawal->no_rekening }} a.n {{ $withdrawal->nama_rekening }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Penarikan</label>
                            <div class="col-sm-12 col-md-7">
                                <span class="bg-info py-1 px-5 rounded text-white mr-2">{{ $withdrawal->status }}</span>
                                @if ($withdrawal->bukti != null)
                                <div class="gallery mt-3">
                                    <div class="gallery-item" data-image="{{ $withdrawal->takeImage() }}"></div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if ($withdrawal->bukti == null)
                        <form method="POST" action="{{ route('bukti.withdrawal.admin', $withdrawal->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload Bukti Pengiriman</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" name="bukti" class="form-control-file @error('bukti') is-invalid @enderror" id="exampleFormControlFile1">
                                    @error('bukti')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <button type="submit" class="btn btn-primary mt-2">Upload</button>
                                </div>
                            </div>
                        </form>
                        @endif
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <a href="{{ route('index.withdrawal.admin') }}" class="btn btn-secondary float-right">Kembali</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush