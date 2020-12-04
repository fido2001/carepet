@extends('layouts.master-user')

@section('header')
Detail Paket {{ $paket->nama_paket }}
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <h5>Nama Petshop : {{ $petshop->name }}</h5>
                <h5>Harga : Rp. {{ $paket->harga }}</h5>
                <h5>Alamat Petshop : {{ $petshop->alamat }}</h5>
                <p>Deskripsi : {!! nl2br($paket->keterangan) !!}</p>
                <a href="/petowner/paket">Kembali</a>
                <a href="{{ route('sale.paket.petowner', $paket->id) }}" class="badge badge-info btn-edit float-right">Pesan</a>
            </div>
        </div>
    </div>
@endsection