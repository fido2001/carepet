@extends('layouts.master-user')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($article->gambar)
                    <img style="height: 550px; object-fit: cover; object-position: center" class="rounded" src="{{ $article->takeImage() }}">
                @endif
                <h1>{{ $article->judul }}</h1>
                <div class="media my-3">
                    <img width="60" class="rounded-circle mr-3" src="{{ asset('../assets/img/avatar/avatar-1.png') }}" alt="">
                    <div class="media-body text-muted">
                        <div>
                            {{ $article->author->name }}
                        </div>
                        {{ '@' . $article->author->username }}
                    </div>
                </div>
                <hr>
                <p>{!! nl2br($article->ulasan) !!}</p>
            </div>
        </div>
        <a href="{{ route('index.article.petowner') }}">Kembali</a>
    </div>
@endsection