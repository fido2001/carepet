@extends('layouts.master-user')

@section('content')
<div class="container">
    <h3>Data Konsultasi</h3>
    <div id="container pb-5">
        @foreach ($dataConsultation as $konsultasi)
        <div class="media my-3">
            <div class="media-body pt-3 pb-3 pr-3 pl-3" style="border-style: solid; border-color:#E9E4FE; border-width: 1px; box-shadow: 0px 3px 8px #E9E4FE">
                <h5 class="mt-0 font-weight-bold">{{ $konsultasi->judul }}</h5>
                {{-- <p class="tanggal">{{ $konsultasi->tanggal }} | {{ $konsultasi->waktu }} WIB</p> --}}
                <p>{{ $konsultasi->deskripsi }}</p>
            </div>
        </div>
        <form float-left action="{{ route('store.chat.petowner', $konsultasi->id) }}" method="POST">
            @csrf
            <div class="container">
                <div class="form-group">
                    <h5><label class="font-weight-bold" for="balasan">Balas</label></h5>
                    <input type="hidden" name="id_konsultasi" value="{{ $konsultasi->id }}">
                    <textarea class="form-control" name="balasan" id="balasan" rows="3"></textarea>
                </div>
                <button type="submit" id="submit" class="btn btn-success">Kirim</button>
                <a href="/petowner/consultation" class="btn btn-warning">Kembali</a>
            </div>
        </form>
        @endforeach
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center line">&nbsp;</div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col col-sm-7 align-self-start">
            @foreach ($dataChat as $chat)
            <div class="media mt-3 p-3" style="border-style: solid; border-color:#E9E4FE; border-width: 1px; box-shadow: 0px 3px 8px #E9E4FE; border-radius: 10px;">
                <div class="media-body">
                    <h5 class="font-weight-bold">{{ $chat->name }}</h5>
                    <p class="tanggal" style=" font-size: 13px;">{{ $chat->tanggal }} | {{ $chat->waktu }} WIB</p>
                    <p style="margin-top:-15px;">{{ $chat->balasan }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection