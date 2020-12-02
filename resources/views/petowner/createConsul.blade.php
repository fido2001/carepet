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
                    <option value="{{ $petshop->id }}">{{ $petshop->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- form judul -->
        <div class="form-group">
            <label class="font-weight-bold" for="judul">Keluhan</label>
            <input type="text" class="form-control" name="judul" id="judul" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Judul keluhan maksimal 50 karakter.</small>
        </div>
        <!-- form deskripsi -->
        <div class="form-group">
            <label class="font-weight-bold" for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
            <small id="emailHelp" class="form-text text-muted">Beri penjelasan lebih detail pada keluhanmu sehingga mudah dimengerti. .</small>
        </div>
        <button type="submit" id="submit" class="btn btn-success">Kirim</button>
    </form>
</div>
@endsection