@extends('layouts.master-user')
@section('header', 'Medicine And Food')
@section('content')
<div class="section-body">
    <div class="row">
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
        @forelse ($data_produk as $produk)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <article class="article article-style-b">
                <div class="article-header">
                    <div class="article-image" data-background="{{ asset('assets/img/news/img13.jpg') }}">
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-title">
                        <h2><a href="#">{{ $produk->nama_produk }}</a></h2>
                    </div>
                    <p>Sisa Stok : {{ $produk->stok }}</p>
                    <p>Harga : Rp. {{ $produk->harga }}</p>
                    <div class="article-cta">
                        <a href="{{ route('show.produk.petowner', $produk->id) }}">Detail Produk <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </article>
        </div>
        @empty
        <div class="col-md-6">
            <div class="alert alert-info">
                Belum ada produk.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection