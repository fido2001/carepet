@extends('layouts.master')

@section('content')

<div class="section-body">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="section-title">Artikel</h2>
        <a href="{{ route('create.article.admin') }}" class="btn btn-success">Tambah Artikel</a>
    </div>
    @if (session()->has('success'))
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        @forelse ($article as $art)
            <div class="col-12 col-md-4 col-lg-4">
                <article class="article article-style-c">
                    @if ($art->gambar)
                    <a href="{{ route('show.article.admin', $art->slug) }}">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ $art->takeImage() }}">
                            </div>
                        </div>
                    </a>
                    @endif
                    <div class="article-details">
                        <div class="article-category"><a>Dibuat {{ $art->created_at->diffForHumans() }}</a></div>
                        <div class="article-title">
                        <h2><a href="{{ route('show.article.admin', $art->slug) }}">{{ $art->judul }}</a></h2>
                        </div>
                        <p>{!! Str::limit(nl2br($art->ulasan), 100) !!}</p>
                        <div class="article-user align-items-center">
                            <div class="media align-items-center">
                                <img width="40" class="rounded-circle mr-3" src="{{ asset('../assets/img/avatar/avatar-1.png') }}" alt="">
                                <div class="media-body">
                                    <div>
                                        {{ $art->author->name }}
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('edit.article.admin', $art->slug) }}" class="btn btn-warning float-right">Ubah Artikel</a>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-md-6">
                <div class="alert alert-info">
                    Belum ada artikel.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection