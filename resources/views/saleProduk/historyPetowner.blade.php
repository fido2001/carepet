@extends('layouts.master-user')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('header', 'History Data Pesanan Medicine and Food')

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
                        <th scope="col">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataPembelian as $no => $pembelian)
                            <tr>
                                <th scope="row">{{ $no+1 }}</th>
                                <td>{{ $pembelian->nama_produk }}</td>
                                <td>{{ $pembelian->jumlahProduk }}</td>
                                @if ($pembelian->status == null)
                                <td>Menunggu Pembayaran</td>
                                @else
                                <td>{{ $pembelian->status }}</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ route('historyDetail.produk.petowner', $pembelian->id) }}" class="badge badge-success">Detail Pesanan</a>
                                    @if ($pembelian->bukti_pembayaran == null)
                                    <a href="#" data-id="{{ $pembelian->id }}" class="badge badge-danger swal-confirm">
                                        <form action="{{ route('destroy.produk.petowner', $pembelian->id) }}" id="delete{{ $pembelian->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        Batalkan Pesanan
                                    </a>
                                </td>
                                @endif
                            </tr>
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