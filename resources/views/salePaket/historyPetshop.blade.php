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
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
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
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ $pemesanan->nama_paket }}</td>
                                <td>{{ $pemesanan->durasi_pemesanan }} Hari</td>
                                <td>{{ $pemesanan->jenis_hewan }}</td>
                                <td>{{ $pemesanan->status }}</td>
                                <td><a href="{{ route('historyDetail.paket.petshop', $pemesanan->id) }}" class="badge badge-info">Detail</a>
                                @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dalam progress')
                                    {{-- <a href="{{ route('create.progress.petshop', $pemesanan['id']) }}" class="btn btn-warning">Masukkan Progress Hewan</a> --}}
                                    <a href="{{ route('index.progress.petshop', $pemesanan->id) }}" class="badge badge-success">Progress</a></td>
                                @endif
                            </tr>
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