@extends('layouts.master')

@section('header')
Detail Paket {{ $paket->nama_paket }}
@endsection

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <h5>Nama Petshop : {{ $petshop->name }}</h5>
                <h5>Nama Dokter : {{ $petshop->nama_dokter }}</h5>
                <h5>Harga : Rp. {{ $paket->harga }}</h5>
                <h5>Alamat Petshop : {{ $petshop->alamat }}</h5>
                <p>Deskripsi : {!! nl2br($paket->keterangan) !!}</p>
                <a href="/admin/paket">Kembali</a>
            </div>
        </div>
    </div>
@endsection