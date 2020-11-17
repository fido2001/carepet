@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Pemesanan Paket {{ $paket->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('purchase.paket.petowner') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">                               
                            <input type="hidden" name="paket_id" value="{{ $paket->id }}">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" value="{{ $paket->nama_paket }}" disabled>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Harga</label>
                                <input type="text" class="form-control" value="{{ $paket->harga }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Jenis Hewan</label>
                                <input type="text" name="jenis_hewan" class="form-control summernote-simple @error('jenis_hewan') is-invalid @enderror">
                                @error('jenis_hewan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Durasi Pemesanan</label>
                                <input type="number" name="durasi_pemesanan" class="form-control summernote-simple @error('durasi_pemesanan') is-invalid @enderror">
                                @error('durasi_pemesanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                    <a href="/petowner/paket" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection