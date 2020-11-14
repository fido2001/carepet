<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukUser extends Model
{
    protected $table = 'ordering_medicine_food';
    protected $fillable = ['user_id', 'produk_id', 'jumlahProduk', 'alamat', 'catatan', 'noHp'];
}
