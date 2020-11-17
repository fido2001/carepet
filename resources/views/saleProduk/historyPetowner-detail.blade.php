@extends('layouts.master-user')

@section('header', 'Detail Pemesanan Medicine and Food')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataProduk as $produk)
        @foreach ($dataPemesanan as $pemesanan)
        @if ($pemesanan['bukti_pembayaran'] == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran!</div>
                <div><a href="{{ route('pembayaran.produk.petowner', $pemesanan['id']) }}" class="btn btn-warning">Bayar Pesanan Disini</a></div>
            </div>
        @endif
        <h5 class="card-title">Nama Produk : {{ $produk['nama_produk'] }}</h5>
        <?php $totalHarga = $produk['harga'] * $pemesanan['jumlahProduk'] ?>
        <h6 class="card-text">Jumlah Pemesanan : {{ $pemesanan['jumlahProduk'] }}</h5>
        <h6 class="card-text">Total Harga : Rp. {{ $totalHarga }}</h5>
        @endforeach
        @endforeach
        <h6 class="card-text">Alamat : {{ $pemesanan['alamat'] }}</h6>
        <h6 class="card-text">Nomor HP : {{ $pemesanan['noHp'] }}</h6>
        <h6 class="card-text">Catatan : {{ $pemesanan['catatan'] }}</h6>
        <a href="/petowner/historyMedicine" class="card-link">Kembali</a>
    </div>
</div>
@endsection