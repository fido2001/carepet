@extends('layouts.master-user')

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Pemesanan Produk {{ $dataProduk->nama_produk }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('purchase.produk.petowner') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">                               
                            <input type="hidden" name="produk_id" value="{{ $dataProduk->id }}">                               
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
                            <input type="number" class="form-control" name="jumlahProduk">
                            <div class="invalid-feedback">
                                Data tidak boleh kosong, harap diisi
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nomor HP</label>
                                <input type="text" name="noHp" class="form-control summernote-simple">
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control summernote-simple"></textarea>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Catatan</label>
                                <textarea name="catatan" class="form-control summernote-simple"></textarea>
                                <div class="invalid-feedback">
                                    Data tidak boleh kosong, harap diisi
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection