@extends('layouts.master-user')
@section('header', 'Service Packages')
{{-- @section('content')
<div class="section-body">
    <div class="card">
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
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data_paket as $no => $paket)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $paket->nama_paket }}</td>
                        <td>Rp. {{ $paket->harga }}</td>
                        <td>
                            <a href="{{ route('show.paket.petowner', $paket->id) }}" class="badge badge-info btn-edit">Detail</a>
                            <a href="{{ route('sale.paket.petowner', $paket->id) }}" class="badge badge-info btn-edit">Pesan</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}

@section('content')
<div class="section-body">
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
    <div class="row">
        @forelse ($data_paket as $paket)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <article class="article article-style-b">
                <div class="article-header">
                    <div class="article-image" data-background="{{ asset('assets/img/news/img13.jpg') }}">
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-title">
                        <h2><a href="#">{{ $paket->nama_paket }}</a></h2>
                    </div>
                    <p>Harga : Rp. {{ $paket->harga }}</p>
                    <div class="article-cta">
                        <a href="{{ route('show.paket.petowner', $paket->id) }}">Detail Paket <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </article>
        </div>
        @empty
        <div class="col-md-6">
            <div class="alert alert-info">
                Belum ada paket.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection