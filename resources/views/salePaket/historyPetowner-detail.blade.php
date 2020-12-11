@extends('layouts.master-user')

@section('header', 'Detail Pemesanan Service Packages')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPemesanan as $pemesanan)
        @if (Carbon\Carbon::now()->setTimeZone('Asia/Jakarta') < $pemesanan->payment_due && $pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran | Batas waktu 1 X 24 Jam | Berakhir dalam <span id="clock"></span></div>
                <div><a href="{{ route('pembayaran.paket.petowner', $pemesanan->id) }}" class="btn btn-warning">Bayar Pesanan Disini</a></div>
            </div>
        @endif
        @if (Carbon\Carbon::now()->setTimeZone('Asia/Jakarta') > $pemesanan->payment_due && $pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Pesanan telah dibatalkan, karena melebihi batas tenggat pembayaran</div>
                <div><a href="/petowner/paket" class="btn btn-warning">Mulai Pesanan Baru Disini</a></div>
            </div>
        @endif
        <h5 class="card-title">Detail Pemesanan {{ $pemesanan->nama_paket }}</h5>
        <h5 class="card-title">Nama Pet Shop : {{ $pemesanan->name }}</h5>
        <h5 class="card-title">Alamat Pet Shop : {{ $pemesanan->alamat }}</h5>
        <?php $totHarga=$pemesanan->harga*$pemesanan->durasi_pemesanan ?>
        <h6 class="card-text">Total Harga : {{ $totHarga }}</h5>
        <h6 class="card-text">Jenis Hewan : {{ $pemesanan->jenis_hewan }}</h5>
        <h6 class="card-text">Durasi Pemesanan : {{ $pemesanan->durasi_pemesanan }} Hari</h5>
        <h6 class="card-text">Tanggal Pemesanan : {{ $pemesanan->getTanggalPesan() }}</h5>
        <h6 class="card-text">Tanggal Selesai : {{ $pemesanan->getTanggalSelesai() }}</h5>
        @endforeach
        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
        @if ($pemesanan->bukti_pembayaran != null && $pemesanan->status == 'dalam progress')
        <a href="{{ route('index.progress.petowner', $pemesanan->id) }}" class="badge badge-success">Progress Hewan</a>    
        @endif
        <a href="/petowner/historyPackages" class="card-link float-right">Kembali</a>
    </div>
</div>
@endsection

@push('after-scripts')
    <script>
    // Set the date we're counting down to
    var countDownDate = new Date('{{ $pemesanan->payment_due }}').getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("clock").innerHTML = hours + " Jam "
    + minutes + " Menit " + seconds + " Detik ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("clock").innerHTML = "EXPIRED";
    }
    }, 1000);
    </script>
@endpush