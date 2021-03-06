@extends('layouts.master-user')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-3" href="{{ route('index.consultation.petowner') }}" role="button">Daftar Konsultasi</a>
    <form float-left action="{{ route('store.consultation.petowner') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="petshop">Pilih Pet Shop</label>
            <select name="id_penerima" id="petshop" class="form-control @error('id_penerima') is-invalid @enderror">
                <option disabled selected>Pilih Salah Satu</option>
                @foreach ($dataPetshop as $petshop)
                    <option value="{{ $petshop->id }}">{{ $petshop->name }} | {{ $petshop->nama_dokter }} | {{ $petshop->alamat }}</option>
                @endforeach
            </select>
            @error('id_penerima')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- form judul -->
        <div class="form-group">
            <label class="font-weight-bold" for="judul">Keluhan</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" aria-describedby="emailHelp" autocomplete="off">
            <small id="emailHelp" class="form-text text-muted">Keluhan maksimal 50 karakter.</small>
            @error('judul')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- form deskripsi -->
        <div class="form-group">
            <label class="font-weight-bold" for="deskripsi">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="3"></textarea>
            @error('deskripsi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" id="submit" class="btn btn-success">Kirim</button>
    </form>
</div>
@endsection