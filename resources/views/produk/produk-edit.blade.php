@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Produk</h4></div>
        <form method="post" action="{{ route('update.produk.petshop', $dataProduk) }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $dataProduk->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ $dataProduk->nama_produk }}">
                        @error('nama_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Stok</label>
                        <input type="number" min="0" step="1" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ $dataProduk->stok }}">
                        @error('stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $dataProduk->harga }}">
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Deskripsi Produk</label>
                        <textarea type="number" class="form-control @error('deskripsi_produk') is-invalid @enderror" name="deskripsi_produk">{{ $dataProduk->deskripsi_produk }}</textarea>
                        @error('deskripsi_produk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label for="exampleFormControlFile1">Gambar Produk</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="exampleFormControlFile1">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('index.produk.petshop') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
@endsection