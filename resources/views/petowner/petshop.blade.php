@extends('layouts.master-user')

@section('title', 'Daftar Pet Shop | CarePet')
@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('header', 'Daftar Pet Shop')
@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Petshop</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $no => $user)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $user->name }}</td>
                            @if ($user->nama_dokter != null)
                            <td>{{ $user->nama_dokter }}</td>
                            @else
                            <td>Dokter Tidak Tersedia</td>
                            @endif
                            <td>{{ $user->noHp }}</td>
                            <td class="text-center">
                                <a href="{{ route('detail.petshop', $user->id) }}" class="badge badge-info btn-edit">Detail</a>
                            </td>
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