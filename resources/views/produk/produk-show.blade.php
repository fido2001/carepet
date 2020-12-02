@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Produk {{ $dataProduk->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <h5>Sisa Stok : {{ $dataProduk->stok }}</h5>
                <h5>Harga : Rp. {{ $dataProduk->harga }}</h5>
                <p>Deskripsi : {{ $dataProduk->deskripsi_produk }}</p>
                <a href="/petowner/produk">Kembali</a>
                <a href="{{ route('sale.produk.petowner', $dataProduk->id) }}" class="badge badge-info btn-edit float-right">Pesan</a>
            </div>
        </div>
    </div>
@endsection