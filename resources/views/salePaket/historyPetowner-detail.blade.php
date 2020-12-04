@extends('layouts.master-user')

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPaket as $paket)
        @foreach ($dataPemesanan as $pemesanan)
        @if ($pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran!</div>
                <div><a href="{{ route('pembayaran.paket.petowner', $pemesanan->id) }}" class="btn btn-warning">Bayar Pesanan Disini</a></div>
            </div>
        @endif
        <h5 class="card-title">Detail Pemesanan {{ $paket['nama_paket'] }}</h5>
        <?php $totHarga=$paket['harga']*$pemesanan->durasi_pemesanan ?>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Jenis Hewan : {{ $pemesanan->jenis_hewan }}</h5>
        <h6 class="card-text">Durasi Pemesanan : {{ $pemesanan->durasi_pemesanan }} Hari</h5>
        <h6 class="card-text">Tanggal Pemesanan : {{ $pemesanan->getTanggalPesan() }}</h5>
        <h6 class="card-text">Tanggal Selesai : {{ $pemesanan->getTanggalSelesai() }}</h5>
        @endforeach
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == 1)
        <a href="{{ route('index.progress.petowner', $pemesanan->id) }}" class="badge badge-success">Progress Hewan</a>    
        @endif
        <a href="/petowner/historyPackages" class="card-link float-right">Kembali</a>
    </div>
</div>
@endsection