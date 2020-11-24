@extends('layouts.master')

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
                        <th scope="col">Jumlah Pemesanan</th>
                        {{-- <th scope="col">Nomor HP</th> --}}
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>    
                <tbody>
                @foreach ($dataPemesanan as $no => $pemesanan)
                    {{-- @foreach ($dataPaket as $no => $paket) --}}
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $pemesanan->nama_produk }}</td>
                            <td>{{ $pemesanan->jumlahProduk }} Item</td>
                            {{-- <td>{{ $pemesanan->noHp }}</td> --}}
                            <td>
                                @if ($pemesanan->bukti_pembayaran == null)
                                <p class="badge badge-danger">Belum Bayar</p> 
                                @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == null)
                                <p class="badge badge-info">Lakukan Verifikasi</p> 
                                @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == '1')
                                <p class="badge badge-success">Sudah Verifikasi</p> 
                                @endif
                            </td>
                            <td><a href="{{ route('historyDetail.produk.petshop', $pemesanan->id) }}" class="badge badge-info">Detail</a></td>
                        </tr>
                    {{-- @endforeach --}}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection