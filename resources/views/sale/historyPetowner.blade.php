@extends('layouts.master-user')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pemesanan Produk</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Harga Satuan</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dataPembelian as $no => $pembelian)
                    @foreach ($dataProduk as $no => $produk)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $produk['nama_produk'] }}</td>
                            <td>{{ $pembelian['jumlahProduk'] }}</td>
                            
                            <td>Rp. {{ $produk['harga'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection