<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketUser extends Model
{
    protected $table = 'ordering_service_packages';
    protected $fillable = ['user_id', 'paket_id', 'jenis_hewan', 'durasi_pemesanan', 'no_rek_pengirim', 'nama_pengirim', 'tgl_kirim', 'bukti_pembayaran'];
}
