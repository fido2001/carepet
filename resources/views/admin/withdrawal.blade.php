@extends('layouts.master')

@section('title', 'Penarikan Dana | CarePet')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pengajuan Penarikan Saldo</h4>
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
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Jumlah Penarikan</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
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
                            <a href="/admin/withdrawal/{{ $withdraw->id }}/detail" class="badge badge-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection