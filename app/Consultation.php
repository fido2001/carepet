<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultation';

    protected $fillable = ['id_pengirim', 'id_penerima', 'judul', 'deskripsi'];

    public function chat()
    {
        return $this->hasMany(Chat::class, 'id_konsultasi');
    }
}
