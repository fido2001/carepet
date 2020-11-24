@extends('layouts.master')

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataProduk as $produk)
        @foreach ($dataPemesanan as $pemesanan)
        <h5 class="card-title">Detail Pemesanan {{ $produk['nama_produk'] }}</h5>
        <?php $totHarga=$produk['harga']*$pemesanan->jumlahProduk ?>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Nama Pengirim : {{ $pemesanan->nama_pengirim }}</h6>
        <h6 class="card-text">Nomor Rekening : {{ $pemesanan->no_rek_pengirim }}</h6>
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == '1')
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px">
        @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == null)
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px" class="mb-3"><br>
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        <a class="badge badge-info" href="{{ route('verifikasi.pembayaran.petshop', $pemesanan->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Pembayaran
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaran.petshop', $pemesanan->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_pembayaran" value="1">
        </form>
        @endif
        @endforeach
        @endforeach
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="/petshop/historyMedicine" class="card-link">Kembali</a>
    </div>
</div>
@endsection