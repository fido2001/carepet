@extends('layouts.master')

@section('title', 'User Management | CarePet')
@section('header', 'Admin')
@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data User</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data Pet Shop
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Roles</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $no => $user)
                    <tr>
                        <th scope="row">{{ $no+1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray())  }}</td>
                        <td class="text-center">
                            <a href="{{ route('edit.users-management', $user->id) }}" class="badge badge-info btn-edit">Edit</a>
                            <a href="#" data-id="{{ $user->id }}" class="badge badge-danger swal-confirm">
                                <form action="{{ route('destroy.users-management', $user->id) }}" id="delete{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                </form>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    @section('modal')
        <!-- Modal Tambah Data Pet Shop-->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Pet Shop</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('store.petshop') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label @error('name')
                                            class="text-danger"
                                        @enderror>Nama Pemilik Pet Shop @error('name')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('username')
                                            class="text-danger"
                                        @enderror>Username @error('username')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="text" name="username" value="{{ old('username') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('email')
                                            class="text-danger"
                                        @enderror>Email @error('email')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('password')
                                            class="text-danger"
                                        @enderror>Password @error('password')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('password_confirmation')
                                            class="text-danger"
                                        @enderror>Konfirmasi Password @error('password_confirmation')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('noHp')
                                            class="text-danger"
                                        @enderror>Nomor Handphone @error('noHp')
                                            {{ $message }}
                                        @enderror</label>
                                        <input type="text" name="noHp" value="{{ old('noHp') }}" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label @error('alamat')
                                            class="text-danger"
                                        @enderror>Alamat @error('alamat')
                                            {{ $message }}
                                        @enderror</label>
                                        <textarea type="text" name="alamat" value="{{ old('alamat') }}" class="form-control" autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endsection

@push('page-scripts')
<script src="{{ asset('../assets/modules/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('after-scripts')
<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Yakin hapus data?',
            text: 'Data yang sudah dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal('Poof! File anda berhasil dihapus!', {
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