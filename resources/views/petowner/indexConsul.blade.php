@extends('layouts.master-user')

@section('header')
<a class="btn btn-primary" href="{{ route('create.consultation.petowner') }}" role="button">Buat Konsultasi</a>  
@endsection
@section('content')
<div class="container bg-white">
    <!-- kolom konsultasi -->
    @forelse ($dataConsultation as $konsultasi)
        <div class="media mt-3 mr-3">
            <div class="media-body pt-3 pb-3 pr-3 pl-3" style="border-style: solid; border-color:#E9E4FE; border-width: 1px; box-shadow: 0px 3px 8px #E9E4FE">
                <h5 class="mt-0 font-weight-bold">{{ $konsultasi->judul }}</h5>
                {{-- <p class="tanggal">{{ $konsultasi->tanggal }} | {{ $konsultasi->waktu }} WIB</p> --}}
                <p>{{ $konsultasi->deskripsi }}</p>
                <a class="btn btn-success mr-3 float-right" href="{{ route('index.chat.petowner', $konsultasi->id) }}" role="button">
                    Chatting
                </a>
            </div>
        </div>
        @empty
        <div class="col-md-6">
            <div class="alert alert-info">
                Belum ada Konsultasi.
            </div>
        </div>
        @endforelse
    <!-- kolom konsultasi -->
</div>    
@endsection