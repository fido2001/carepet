@extends('layouts.master-user')

@section('header', 'Data Progress Service Packages')
@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            @foreach ($dataPemesanan as $pemesanan)
            @foreach ($dataPaket as $paket)
            <h5 class="card-title">Data Progress {{ $paket['nama_paket'] }}</h5>
            <h6 class="card-text">Jenis Hewan : {{ $pemesanan['jenis_hewan'] }}</h5>
            <h6 class="card-text">Nama Pemilik : {{ $pemesanan['nama_pengirim'] }}</h5>
            {{-- <a href="{{ route('create.progress.petshop', $pemesanan['id']) }}" class="badge badge-success my-3">Masukkan Progress Hewan</a> --}}
            @endforeach
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                    <th scope="col">Hari Ke-</th>
                    <th scope="col">Kondisi Hewan</th>
                    <th scope="col">Foto</th>
                    {{-- <th scope="col" class="text-center">Action</th> --}}
                </tr>
                </thead>
                <tbody>
                    @foreach ($dataProgress as $no => $progress)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $progress->hari_ke }}</td>
                        <td>{{ $progress->kondisi_hewan }}</td>
                        <td><img src="{{ $progress->takeImage() }}" alt="" style="height: 100px"></td>
                        {{-- <td class="text-center">
                            <a href="{{ route('edit.progress.petshop', $progress->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $progress->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('destroy.progress.petshop', $progress->id) }}" id="delete{{ $progress->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                </form>
                                Hapus Progress
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/petowner/historyPackages/{{ $pemesanan['id'] }}">Kembali</a>
            @endforeach
        </div>
    </div>
</div>
@endsection