@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPemesanan as $pemesanan)
        <h5 class="card-title">Detail Pemesanan {{ $pemesanan->nama_paket }}</h5>
        <?php $totHarga=$pemesanan->harga*$pemesanan->durasi_pemesanan ?>
        <h6 class="card-text">Nama Pengirim : {{ $pemesanan->nama_pengirim }}</h5>
        <h6 class="card-text">Nomor Rekening : {{ $pemesanan->no_rek_pengirim }}</h5>
        <h6 class="card-text">Durasi Pemesanan : {{ $pemesanan->durasi_pemesanan }} Hari</h5>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Jenis Hewan : {{ $pemesanan->jenis_hewan }}</h6>
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dalam progress')
        <h6 class="card-text">Bukti Pembayaran : </h6>
        <div class="gallery">
            <div class="gallery-item" data-image="{{ $pemesanan->takeImage() }}"></div>
        </div>
        @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'diterima')
        <h6 class="card-text">Bukti Pembayaran : </h6>
        <div class="gallery">
            <div class="gallery-item" data-image="{{ $pemesanan->takeImage() }}"></div>
        </div><br>
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        <a class="badge badge-info" href="{{ route('verifikasi.pembayaranPaket.admin', $pemesanan->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Pembayaran
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaranPaket.admin', $pemesanan->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_pembayaran" value="dalam progress">
        </form>
        @endif
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <br><br><a href="/admin/historyPackages" class="card-link">Kembali</a>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush