@extends('layouts.master-user')

@section('header', 'Detail Pemesanan Medicine and Food')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPemesanan as $pemesanan)
        @if (Carbon\Carbon::now()->setTimeZone('Asia/Jakarta') < $pemesanan->payment_due && $pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran | Batas waktu 1 X 24 Jam</div>
                <div><a href="{{ route('pembayaran.produk.petowner', $pemesanan->id) }}" class="btn btn-warning">Bayar Pesanan Disini</a></div>
            </div>
        @endif
        @if (Carbon\Carbon::now()->setTimeZone('Asia/Jakarta') > $pemesanan->payment_due && $pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Pesanan telah dibatalkan, karena melebihi batas tenggat pembayaran</div>
                <div><a href="/petowner/produk" class="btn btn-warning">Mulai Pesanan Baru Disini</a></div>
            </div>
        @endif
        <h5 class="card-title">Nama Produk : {{ $pemesanan->nama_produk }}</h5>
        <h5 class="card-title">Nama Pet Shop : {{ $pemesanan->name }}</h5>
        <?php $totalHarga = $pemesanan->harga * $pemesanan->jumlahProduk ?>
        <h6 class="card-text">Jumlah Pemesanan : {{ $pemesanan->jumlahProduk }}</h5>
        <h6 class="card-text">Total Harga : Rp. {{ $totalHarga }}</h5>
        <h6 class="card-text">Alamat : {{ $pemesanan->alamat }}</h6>
        <h6 class="card-text">Nomor HP : {{ $pemesanan->noHp }}</h6>
        <h6 class="card-text">Catatan : {{ $pemesanan->catatan }}</h6>
        <h6 class="card-text">Status : {{ $pemesanan->status }}</h6>
        @if ($pemesanan->resi != null)
        <h6 class="card-text">Resi Pengiriman : {{ $pemesanan->resi }}</h6>
        @endif
        <a href="/petowner/historyMedicine" class="card-link">Kembali</a>
        @if ($pemesanan->status == 'dikirim')
        <a class="btn btn-success float-right" href="/petowner/historyMedicine/{{ $pemesanan->id }}/diterima" class="card-link">Pesanan Diterima</a>
        @endif
        @endforeach
    </div>
</div>
@endsection