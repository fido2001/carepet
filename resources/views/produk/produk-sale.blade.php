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
                            <div class="form-group col-md-6 col-12">
                                <label>Nomor HP</label>
                                <input type="text" name="noHp" class="form-control summernote-simple @error('noHp') is-invalid @enderror">
                                @error('noHp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Kecamatan</label>
                                <select name="kecamatan" id="" class="form-control @error('kecamatan') is-invalid @enderror">
                                    <option disabled selected>Pilih Salah Satu</option>
                                    <option value="Ajung">Ajung</option>
                                    <option value="Ambulu">Ambulu</option>
                                    <option value="Arjasa">Arjasa</option>
                                    <option value="Bangsalsari">Bangsalsari</option>
                                    <option value="Balung">Balung</option>
                                    <option value="Gumukmas">Gumukmas</option>
                                    <option value="Jelbuk">Jelbuk</option>
                                    <option value="Jenggawah">Jenggawah</option>
                                    <option value="Jombang">Jombang</option>
                                    <option value="Kalisat">Kalisat</option>
                                    <option value="Kaliwates">Kaliwates</option>
                                    <option value="Kencong">Kencong</option>
                                    <option value="Ledokombo">Ledokombo</option>
                                    <option value="Mayang">Mayang</option>
                                    <option value="Mumbulsari">Mumbulsari</option>
                                    <option value="Panti">Panti</option>
                                    <option value="Pakusari">Pakusari</option>
                                    <option value="Patrang">Patrang</option>
                                    <option value="Puger">Puger</option>
                                    <option value="Rambipuji">Rambipuji</option>
                                    <option value="Semboro">Semboro</option>
                                    <option value="Silo">Silo</option>
                                    <option value="Sukorambi">Sukorambi</option>
                                    <option value="Sukowono">Sukowono</option>
                                    <option value="Sumberbaru">Sumberbaru</option>
                                    <option value="Sumberjambe">Sumberjambe</option>
                                    <option value="Sumbersari">Sumbersari</option>
                                    <option value="Tanggul">Tanggul</option>
                                    <option value="Tempurejo">Tempurejo</option>
                                    <option value="Umbulsari">Umbulsari</option>
                                    <option value="Wuluhan">Wuluhan</option>
                                </select>
                                @error('kecamatan')
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