<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'pilihan_paket';

    protected $fillable = ['nama_paket', 'harga', 'keterangan', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ordering_service_packages', 'paket_id', 'user_id');
    }
}
