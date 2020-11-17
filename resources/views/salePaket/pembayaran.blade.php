@extends('layouts.master-user')

@section('header', 'Pembayaran Service Packages')
@section('content')
<div class="section-body">
    <div class="card">
        @foreach ($dataPaket as $paket)
        @foreach ($dataPemesanan as $pemesanan)
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Pembayaran Paket {{ $paket['nama_paket'] }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pembayaran.paket.petowner', $pemesanan['id']) }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">                               
                        <input type="hidden" name="paket_id" value="{{ $pemesanan['id'] }}">                               
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control" value="{{ $paket['nama_paket'] }}" disabled>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Harga</label>
                            <?php $totHarga=$paket['harga']*$pemesanan['durasi_pemesanan'] ?>
                            <input type="text" class="form-control" value="{{ $totHarga }}" disabled>
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Pengirim</label>
                            <input type="text" name="nama_pengirim" class="form-control summernote-simple @error('nama_pengirim') is-invalid @enderror">
                            @error('nama_pengirim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Nomor Rekening</label>
                            <input type="text" name="no_rek_pengirim" class="form-control summernote-simple @error('no_rek_pengirim') is-invalid @enderror">
                            @error('no_rek_pengirim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="exampleFormControlFile1">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" id="exampleFormControlFile1">
                            @error('bukti_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="/petowner/historyPackages/{{ $pemesanan['id'] }}" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection