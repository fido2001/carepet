@extends('layouts.master')

@section('title', 'Order History | CarePet')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pemesanan Paket</h4>
        </div>
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
                            <th scope="col">Aksi</th>
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
                                <td>{{ $pemesanan->status }}</td>
                                <td><a href="{{ route('historyDetail.paket.admin', $pemesanan->id) }}" class="badge badge-info">Detail</a></td>
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