<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukUser extends Model
{
    protected $table = 'ordering_medicine_food';
    protected $fillable = ['user_id', 'produk_id', 'jumlahProduk', 'alamat', 'catatan', 'noHp', 'nominal', 'payment_due', 'no_rek_pengirim', 'nama_pengirim', 'tgl_kirim', 'bukti_pembayaran', 'status'];

    public function takeImage()
    {
        return "/storage/" . $this->bukti_pembayaran;
    }
}
