@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Produk {{ $dataProduk->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <img style="height: 350px; object-fit: cover; object-position: center" class="rounded" src="{{ $dataProduk->takeImage() }}">
                <h4>Nama Petshop : {{ $petshop->name }}</h4>
                <h4>Alamat Petshop : {{ $petshop->alamat }}</h4>
                <h6>Sisa Stok : {{ $dataProduk->stok }}</h6>
                <h6>Harga : Rp. {{ $dataProduk->harga }}</h6>
                <p>Deskripsi : {{ $dataProduk->deskripsi_produk }}</p>
                <a href="/petowner/produk">Kembali</a>
                <a href="{{ route('sale.produk.petowner', $dataProduk->id) }}" class="badge badge-info btn-edit float-right">Pesan</a>
            </div>
        </div>
    </div>
@endsection