<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketUser extends Model
{
    protected $table = 'ordering_service_packages';
    protected $fillable = ['user_id', 'paket_id', 'jenis_hewan', 'durasi_pemesanan', 'no_rek_pengirim', 'status_pembayaran', 'nama_pengirim', 'tgl_kirim', 'bukti_pembayaran'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_service');
    }

    public function takeImage()
    {
        return "/storage/" . $this->bukti_pembayaran;
    }
}
