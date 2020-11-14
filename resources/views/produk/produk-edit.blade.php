@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header"><h4>Edit Data Produk</h4></div>
        <form method="post" action="{{ route('update.produk.petshop', $dataProduk) }}" class="needs-validation" novalidate="">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $dataProduk->id }}">
            <div class="card-body">
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" value="{{ $dataProduk->nama_produk }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Stok</label>
                        <input type="number" class="input form-control" name="stok" value="{{ $dataProduk->stok }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Harga</label>
                        <input type="number" class="input form-control" name="harga" value="{{ $dataProduk->harga }}" required="">
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
                    </div>
                </div>
                <div class="row">                               
                    <div class="form-group col-md-6 col-12">
                        <label>Deskripsi Produk</label>
                        <textarea type="number" class="form-control" name="deskripsi_produk" required="">{{ $dataProduk->deskripsi_produk }}</textarea>
                        <div class="invalid-feedback">
                            Data tidak boleh kosong, harap diisi!
                        </div>
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