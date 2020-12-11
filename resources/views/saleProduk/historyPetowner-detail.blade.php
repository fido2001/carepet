@extends('layouts.master-user')

@section('header', 'Detail Pemesanan Medicine and Food')
@section('content')
<div class="card">
    <div class="card-body">
        @foreach ($dataPemesanan as $pemesanan)
        @if ($pemesanan->bukti_pembayaran == null)
            <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                <div>Segera lakukan pembayaran | Batas waktu 1 X 24 Jam | Berakhir dalam <span id="clock"></span></div>
                <div><a href="{{ route('pembayaran.produk.petowner', $pemesanan->id) }}" class="btn btn-warning">Bayar Pesanan Disini</a></div>
            </div>
        @endif
        <h5 class="card-title">Nama Produk : {{ $pemesanan->nama_produk }}</h5>
        <h5 class="card-title">Nama Pet Shop : {{ $pemesanan->name }}</h5>
        <?php $totalHarga = $pemesanan->harga * $pemesanan->jumlahProduk ?>
        <h6 class="card-text">Jumlah Pemesanan : {{ $pemesanan->jumlahProduk }}</h5>
        <h6 class="card-text">Total Harga : Rp. {{ $totalHarga }}</h5>
        <h6 class="card-text">Alamat : {{ $pemesanan->alamat }}</h6>
        <h6 class="card-text">Nomor HP : {{ $pemesanan->noHp }}</h6>
        <h6 class="card-text">Catatan : {{ $pemesanan->catatan }}</h6>
        <h6 class="card-text">Status : {{ $pemesanan->status }}</h6>
        @if ($pemesanan->resi != null)
        <h6 class="card-text">Resi Pengiriman : {{ $pemesanan->resi }}</h6>
        @endif
        <a href="/petowner/historyMedicine" class="card-link">Kembali</a>
        @if ($pemesanan->status == 'dikirim')
        <a class="btn btn-success float-right" href="/petowner/historyMedicine/{{ $pemesanan->id }}/diterima" class="card-link">Pesanan Diterima</a>
        @endif
        @endforeach
    </div>
</div>
@endsection

@push('after-scripts')
    <script>
    // Set the date we're counting down to
    var countDownDate = new Date('{{ $order->batas_pembayaran }}').getTime();

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