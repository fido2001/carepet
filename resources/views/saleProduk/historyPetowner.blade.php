@extends('layouts.master-user')

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
        @endif
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dataPembelian as $no => $pembelian)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $pembelian->nama_produk }}</td>
                            <td>{{ $pembelian->jumlahProduk }}</td>
                            <td>{{ $pembelian->alamat }}</td>
                            <td>{{ $pembelian->noHp }}</td>
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
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
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