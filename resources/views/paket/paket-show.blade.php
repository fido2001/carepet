@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Paket {{ $paket->nama_paket }}</h4>
            </div>
            <div class="card-body">
                <h5>Harga : Rp. {{ $paket->harga }}</h5>
                <p>Deskripsi : {!! nl2br($paket->keterangan) !!}</p>
                <a href="/petowner/paket">Kembali</a>
                <a href="{{ route('sale.paket.petowner', $paket->id) }}" class="badge badge-info btn-edit float-right">Pesan</a>
            </div>
        </div>
    </div>
@endsection