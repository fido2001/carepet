<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    protected $table = 'data_produk';

    protected $fillable = ['nama_produk', 'stok', 'harga', 'deskripsi_produk'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ordering_medicine_food', 'produk_id', 'user_id');
    }
}
