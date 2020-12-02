@extends('layouts.master')

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPaket as $paket)
        @foreach ($dataPemesanan as $pemesanan)
        <h5 class="card-title">Detail Pemesanan {{ $paket['nama_paket'] }}</h5>
        <?php $totHarga=$paket['harga']*$pemesanan['durasi_pemesanan'] ?>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Jenis Hewan : {{ $pemesanan['jenis_hewan'] }}</h5>
        @endforeach
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <a href="/petshop/historyPackages" class="card-link">Kembali</a>
    </div>
</div>
@endsection