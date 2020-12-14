@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        @if (session('warning'))
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('warning') }}
                </div>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Pemesanan Produk {{ $dataProduk->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('purchase.produk.petowner', $dataProduk->id) }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">                               
                            <input type="hidden" name="produk_id" value="{{ $dataProduk->id }}">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Petshop</label>
                                <input type="text" class="form-control" value="{{ $petshop->name }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat Petshop</label>
                                <input type="text" class="form-control" value="{{ $petshop->alamat }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" value="{{ $dataProduk->nama_produk }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Harga</label>
                                <input type="text" class="form-control" value="{{ $dataProduk->harga }}" disabled>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Sisa Stok</label>
                            <input type="text" class="form-control" value="{{ $dataProduk->stok }}" disabled>
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Jumlah Pemesanan</label>
                            <input type="number" min="1" class="form-control @error('jumlahProduk') is-invalid @enderror" name="jumlahProduk">
                            @error('jumlahProduk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nomor HP</label>
                                <input type="text" name="noHp" class="form-control summernote-simple @error('noHp') is-invalid @enderror">
                                @error('noHp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control summernote-simple @error('alamat') is-invalid @enderror"></textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Catatan</label>
                                <textarea name="catatan" class="form-control summernote-simple @error('catatan') is-invalid @enderror"></textarea>
                                @error('catatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                    <a href="/petowner/produk/{{ $dataProduk->id }}" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection