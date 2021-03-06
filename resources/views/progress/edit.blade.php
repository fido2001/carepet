@extends('layouts.master')

@section('header', 'Data Progress Service Packages')
@section('content')
<div class="section-body">
    <div class="card">
        {{-- @foreach ($dataPaket as $paket)
        @foreach ($dataProgress as $progress) --}}
        {{-- @foreach ($dataPemesanan as $pemesanan) --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Progress</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('update.progress.petshop', $progress->id) }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    {{-- <div class="row">                                                      
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control" value="{{ $paket['nama_paket'] }}" disabled>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Pemilik</label>
                            <input type="text" class="form-control" value="{{ $pemesanan['nama_pengirim'] }}" disabled>
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Progress Hari ke-</label>
                            <input type="text" name="hari_ke" value="{{ $progress->hari_ke }}" class="form-control summernote-simple @error('hari_ke') is-invalid @enderror">
                            @error('hari_ke')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="exampleFormControlFile1">Foto Progress</label>
                            <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" id="exampleFormControlFile1">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-12">
                            <label>Kondisi Hewan</label>
                            <textarea type="text" name="kondisi_hewan" class="form-control summernote-simple @error('kondisi_hewan') is-invalid @enderror">{{ $progress->kondisi_hewan }}</textarea>
                            @error('kondisi_hewan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="/petshop/historyPackages" class="btn btn-warning">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        {{-- @endforeach --}}
        {{-- @endforeach
        @endforeach --}}
    </div>
</div>
@endsection