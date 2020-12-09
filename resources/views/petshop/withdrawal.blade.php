@extends('layouts.master')

@section('title', 'Penarikan Saldo | CarePet')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
    <div class="container">
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
        @elseif (session('fail'))
        <div class="card-body">
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('fail') }}
                </div>
            </div>
        </div>
        @endif
        <div class="row no-gutters title-page">
            <div class="col-sm-12 text-center">
                <h3>Penarikan Saldo</h3>
            </div>
        </div>
    
        <div class="row no-gutters my-3">
            <div class="col-sm-12 text-center">
                <span style="font-size: 17px">Saldo anda saat ini</span>
                <h1 style="font-size: 80px;" class="p-3">Rp {{ $saldo }}</h1>
                <a href="/petshop/withdrawal/create" class="btn btn-primary">+ Ajukan Penarikan</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table-1">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Jumlah Penarikan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($withdrawal as $no => $withdraw)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ Carbon\Carbon::parse($withdraw->tanggal_pengajuan)->translatedFormat('l, d F Y') }}</td>
                                <td>Rp. {{ $withdraw->jml_penarikan }}</td>
                                <td>{{ $withdraw->status }}</td>
                                <td class="text-center">
                                    <a href="/petshop/withdrawal/{{ $withdraw->id }}/detail" class="badge badge-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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