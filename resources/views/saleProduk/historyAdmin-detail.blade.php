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
        <h6 class="card-text">Jumlah Pembelian : {{ $pemesanan->jumlahProduk }} Item</h6>
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikemas')
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px">
        @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'diterima')
        <h6 class="card-text">Bukti Pembayaran : </h6>
        <div class="gallery">
            <div class="gallery-item" data-image="{{ $pemesanan->takeImage() }}"></div>
        </div><br>
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        <a class="badge badge-info mb-3" href="{{ route('verifikasi.pembayaran.admin', $pemesanan->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Pembayaran
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaran.admin', $pemesanan->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="dikemas">
        </form>
        @endif
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <br><a href="/admin/historyMedicine" class="card-link">Kembali</a>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush