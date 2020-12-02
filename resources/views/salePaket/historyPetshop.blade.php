@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pesanan Paket</h4>
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
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Durasi Pemesanan</th>
                        <th scope="col">Jenis Hewan</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width:190px">Aksi</th>
                    </tr>
                </thead>    
                <tbody>
                @foreach ($dataPemesanan as $no => $pemesanan)
                    {{-- @foreach ($dataPaket as $no => $paket) --}}
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $pemesanan->nama_paket }}</td>
                            <td>{{ $pemesanan->durasi_pemesanan }} Hari</td>
                            <td>{{ $pemesanan->jenis_hewan }}</td>
                            <td>
                                @if ($pemesanan->bukti_pembayaran == null)
                                Belum Bayar
                                @elseif ($pemesanan->bukti_pembayaran != null)
                                Sudah Bayar
                                @endif
                            </td>
                            <td><a href="{{ route('historyDetail.paket.petshop', $pemesanan->id) }}" class="badge badge-info">Detail</a>
                            @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status_pembayaran == 1)
                                {{-- <a href="{{ route('create.progress.petshop', $pemesanan['id']) }}" class="btn btn-warning">Masukkan Progress Hewan</a> --}}
                                <a href="{{ route('index.progress.petshop', $pemesanan->id) }}" class="badge badge-success">Progress</a></td>
                            @endif
                        </tr>
                    {{-- @endforeach --}}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection