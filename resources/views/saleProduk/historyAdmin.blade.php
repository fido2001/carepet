@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pemesanan Produk</h4>
        </div>
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
        @elseif (session('fail'))
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('fail') }}
                </div>
            </div>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jumlah Pemesanan</th>
                            {{-- <th scope="col">Nomor HP</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>    
                    <tbody>
                    @foreach ($dataPemesanan as $no => $pemesanan)
                        {{-- @foreach ($dataPaket as $no => $paket) --}}
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ $pemesanan->nama_produk }}</td>
                                <td>{{ $pemesanan->jumlahProduk }} Item</td>
                                {{-- <td>{{ $pemesanan->noHp }}</td> --}}
                                <td>
                                    @if ($pemesanan->bukti_pembayaran == null)
                                    <a class="badge badge-danger" style="color:white">Belum Bayar</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'diterima')
                                    <a class="badge badge-warning" style="color:white">Menunggu Verifikasi</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikemas')
                                    <a class="badge badge-info" style="color:white">Masukkan Resi</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dikirim')
                                    <a class="badge badge-success" style="color:white">Menunggu Pesanan Diterima</a> 
                                    @elseif ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'pesanan diterima')
                                    <a class="badge badge-success" style="color:white">Pesanan Selesai</a> 
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('historyDetail.produk.admin', $pemesanan->id) }}" class="badge badge-info">Detail</a>
                                    @if ($pemesanan->bukti_pembayaran == null)
                                    <a href="#" data-id="{{ $pemesanan->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('destroy.produk.admin', $pemesanan->id) }}" id="delete{{ $pemesanan->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        Batalkan Pesanan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('../assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('../assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush

@push('page-spesific-scripts')
<script src="{{ asset('../assets/js/page/modules-datatables.js') }}"></script>
@endpush

@push('after-scripts')
<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Yakin batalkan pesanan?',
            text: 'Pesanan yang sudah dibatalkan tidak bisa dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Poof! Pesanan anda berhasil dibatalkan!', {
                icon: 'success',
                });
                $(`#delete${id}`).submit();
            } else {
                // swal('Your imaginary file is safe!');
            }
        });
    });
</script>
@endpush