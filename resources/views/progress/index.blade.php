@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('../assets/modules/chocolat/dist/css/chocolat.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('header', 'Data Progress Service Packages')
@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            @foreach ($dataPemesanan as $pemesanan)
            @foreach ($dataPaket as $paket)
            <h5 class="card-title">Data Progress {{ $paket['nama_paket'] }}</h5>
            <h6 class="card-text">Jenis Hewan : {{ $pemesanan['jenis_hewan'] }}</h5>
            <h6 class="card-text">Nama Pemilik : {{ $pemesanan['nama_pengirim'] }}</h5>
            <a href="{{ route('create.progress.petshop', $pemesanan['id']) }}" class="badge badge-success my-3">Masukkan Progress Hewan</a>
            @endforeach
            <div class="table-responsive">
                <table class="table table-hover" id="table-1">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hari Ke-</th>
                        <th scope="col">Kondisi Hewan</th>
                        <th scope="col">Foto</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataProgress as $no => $progress)
                        <tr>
                            <th scope="row">{{ $no+1 }}</th>
                            <td>{{ $progress->hari_ke }}</td>
                            <td>{{ $progress->kondisi_hewan }}</td>
                            <td>
                                <div class="gallery">
                                    <div class="gallery-item" data-image="{{ $progress->takeImage() }}"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('edit.progress.petshop', $progress->id) }}" class="badge badge-info btn-edit">Edit</a>
                                <a href="#" data-id="{{ $progress->id }}" class="badge badge-danger swal-confirm">
                                    <form action="{{ route('destroy.progress.petshop', $progress->id) }}" id="delete{{ $progress->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    Hapus Progress
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="/petshop/historyPackages">Kembali</a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('../assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
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
            title: 'Yakin hapus progress?',
            text: 'Progress yang sudah dibatalkan tidak bisa dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Poof! Progress berhasil dihapus!', {
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