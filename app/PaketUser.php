<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PaketUser extends Model
{
    protected $table = 'ordering_service_packages';
    protected $fillable = ['user_id', 'paket_id', 'jenis_hewan', 'durasi_pemesanan', 'tgl_pesan', 'tgl_selesai', 'no_rek_pengirim', 'status', 'nama_pengirim', 'tgl_kirim', 'bukti_pembayaran', 'payment_due'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_service');
    }

    public function takeImage()
    {
        return "/storage/" . $this->bukti_pembayaran;
    }

    public function getTanggalPesan()
    {
        return Carbon::parse($this->tgl_pesan)->translatedFormat('l, d F Y');
    }

    public function getTanggalSelesai()
    {
        return Carbon::parse($this->tgl_selesai)->translatedFormat('l, d F Y');
    }
}
