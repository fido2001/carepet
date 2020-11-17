@extends('layouts.master-user')

@section('header', 'History Data Pesanan Paket')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pesanan Paket</h4>
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
                        <th scope="col">ID Pemesanan</th>
                        <th scope="col">Durasi Pemesanan</th>
                        <th scope="col">Jenis Hewan</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>    
                <tbody>
                @foreach ($dataPemesanan as $no => $pemesanan)
                    {{-- @foreach ($dataPaket as $no => $paket) --}}
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $pemesanan['id'] }}</td>
                            <td>{{ $pemesanan['durasi_pemesanan'] }} Hari</td>
                            <td>{{ $pemesanan['jenis_hewan'] }}</td>
                            <td>
                                @if ($pemesanan['bukti_pembayaran'] == null)
                                Belum Bayar
                                @elseif ($pemesanan['bukti_pembayaran'] != null)
                                Sudah Bayar
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('historyDetail.paket.petowner', $pemesanan['id']) }}" class="badge badge-info">Detail Pesanan</a>
                                @if ($pemesanan['bukti_pembayaran'] == null)
                                <a href="#" data-id="{{ $pemesanan['id'] }}" class="badge badge-danger swal-confirm">
                                    <form action="{{ route('destroy.paket.petowner', $pemesanan['id']) }}" id="delete{{ $pemesanan['id'] }}" method="POST">
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