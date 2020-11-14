@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Produk</h4>
        </div>
        @if (session('success'))
        <div class="card-body">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
        @endif
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Deskripsi Produk</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data_produk as $no => $produk)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>Rp. {{ $produk->harga }}</td>
                        <td>{{ $produk->deskripsi_produk }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection