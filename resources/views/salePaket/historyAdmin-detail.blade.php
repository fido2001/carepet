@extends('layouts.master')

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPaket as $paket)
        @foreach ($dataPemesanan as $pemesanan)
        <h5 class="card-title">Detail Pemesanan {{ $paket['nama_paket'] }}</h5>
        <?php $totHarga=$paket['harga']*$pemesanan->durasi_pemesanan ?>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Jenis Hewan : {{ $pemesanan->jenis_hewan }}</h6>
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == '1')
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px">
        @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == null)
        <h6 class="card-text">Bukti Pembayaran : </h6><img src="{{ $pemesanan->takeImage() }}" alt="" style="height: 250px" class="mb-3"><br>
        {{-- <a href="" class="badge badge-info">Verifikasi Pembayaran</a> --}}
        <a class="badge badge-info" href="{{ route('verifikasi.pembayaran.admin', $pemesanan->id) }}"
            onclick="event.preventDefault();
                document.getElementById('verifikasi-form').submit();">
            Verifikasi Pembayaran
        </a>

        <form id="verifikasi-form" action="{{ route('verifikasi.pembayaran.admin', $pemesanan->id) }}" method="POST" class="d-none">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_pembayaran" value="1">
        </form>
        @endif
        @endforeach
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        <br><br><a href="/admin/historyPackages" class="card-link">Kembali</a>
    </div>
</div>
@endsection