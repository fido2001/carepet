@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pemesanan Produk</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
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
                                    <a class="badge badge-danger" style="color:white">Belum Bayar</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'diterima')
                                    <a class="badge badge-warning" style="color:white">Menunggu Verifikasi</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikemas')
                                    <a class="badge badge-info" style="color:white">Masukkan Resi</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikirim')
                                    <a class="badge badge-success" style="color:white">Menunggu Pesanan Diterima</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'pesanan diterima')
                                    <a class="badge badge-success" style="color:white">Pesanan Selesai</a> 
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
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
@endpush