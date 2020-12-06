@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPemesanan as $pemesanan)
        <h5 class="card-title">Detail Pemesanan {{ $pemesanan->nama_produk }}</h5>
        <h6 class="card-text">Total Harga : {{ $pemesanan->nominal }}</h5>
        <h6 class="card-text">Nama Pengirim : {{ $pemesanan->nama_pengirim }}</h6>
        <h6 class="card-text">Alamat Pengiriman : {{ $pemesanan->alamat }}</h6>
        <h6 class="card-text">Jumlah Pembelian : {{ $pemesanan->jumlahProduk }} Pcs</h6>
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikemas')
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px">
        @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'diterima')
        <h6 class="card-text">Bukti Pembayaran : </h6>
        <div class="gallery">
            <div class="gallery-item" data-image="{{ $pemesanan->takeImage() }}"></div>
        </div><br>
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        <a class="badge badge-info" href="{{ route('verifikasi.pembayaran.petshop', $pemesanan->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Pembayaran
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaran.petshop', $pemesanan->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="dikemas">
        </form>
        @endif
        @if ($pemesanan->status == 'dikemas')
        <div class="row mb-3">
            <form id="verifikasi-form" action="{{ route('resi.pengiriman', $pemesanan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="">Masukkan Resi</label>
                    <input type="text" name="resi" class="form-control summernote-simple">
                </div>
                <button type="submit" class="btn btn-success">Kirim Resi</button>
            </form>
        </div>
        @endif
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <a href="/petshop/historyMedicine" class="card-link">Kembali</a>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush