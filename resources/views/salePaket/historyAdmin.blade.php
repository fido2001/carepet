@extends('layouts.master')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pemesanan Paket</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Pemesanan</th>
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
                            <td>{{ $pemesanan['id'] }}</td>
                            <td>{{ $pemesanan['durasi_pemesanan'] }} Hari</td>
                            <td>{{ $pemesanan['jenis_hewan'] }}</td>
                            <td>
                                @if ($pemesanan['bukti_pembayaran'] == null)
                                Belum Bayar
                                @elseif ($pemesanan['bukti_pembayaran'] != null)
                                Sudah Bayar
                                @endif
                            </td>
                            {{-- <td><a href="{{ route('historyDetail.paket.petowner', $pemesanan['id']) }}" class="btn btn-info">Detail</a></td> --}}
                        </tr>
                    {{-- @endforeach --}}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection