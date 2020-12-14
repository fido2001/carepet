@extends('layouts.master-user')

@section('header', 'Pembayaran Medicine and Food')
@section('content')
<div class="section-body">
    <div class="card">
        <div class="invoice">
            @foreach ($dataPemesanan as $pemesanan)
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('success'))
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            {{-- <div class="invoice-number">Order #12345</div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Detail Pemesanan</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Item</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Totals</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $pemesanan->nama_produk }}</td>
                                    <td class="text-center">Rp. {{ $pemesanan->harga }}</td>
                                    <td class="text-center">{{ $pemesanan->jumlahProduk }} Pcs</td>
                                    <td class="text-right">Rp. {{ $pemesanan->harga*$pemesanan->jumlahProduk }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title">Bank Tujuan Pembayaran</div>
                                <div class="row no-gutters justify-content-center align-items-center pb-2">
                                    <img class="img-fluid" src="{{ asset('assets/img/mandiri.png') }}" style="height: 40px" alt="visa">
                                    <h5 class="mb-0">81788900 91029</h5>
                                    <div class="col-4"></div>
                                    <div class="col-8 mt-2"><h6>a.n. PT CarePet Sejahtera Abadi</h6></div>
                                    <div class="col-8 border-bottom mt-2"></div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">Rp. {{ $pemesanan->harga*$pemesanan->jumlahProduk }}</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Shipping</div>
                                    <div class="invoice-detail-value">Rp. 8000</div>
                                </div>
                            <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><h1>Rp. {{ $pemesanan->harga*$pemesanan->jumlahProduk + 8000 }}</h1></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('pembayaran.produk.petowner', $pemesanan->id) }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">                               
                            <input type="hidden" name="paket_id" value="{{ $pemesanan->id }}">                               
                            <?php $totHarga=$pemesanan->harga*$pemesanan->jumlahProduk + 8000 ?>
                            <input type="hidden" name="nominal" value="{{ $totHarga }}">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Pengirim</label>
                                <input type="text" name="nama_pengirim" class="form-control summernote-simple @error('nama_pengirim') is-invalid @enderror" autocomplete="off">
                                @error('nama_pengirim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Nomor Rekening</label>
                                <input type="text" name="no_rek_pengirim" class="form-control summernote-simple @error('no_rek_pengirim') is-invalid @enderror" autocomplete="off">
                                @error('no_rek_pengirim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="exampleFormControlFile1">Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" id="exampleFormControlFile1">
                                @error('bukti_pembayaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                            <a href="/petowner/historyMedicine/{{ $pemesanan->id }}" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection