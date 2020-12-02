<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = ['id_pengirim', 'id_konsultasi', 'balasan', 'tanggal', 'waktu'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_konsultasi');
    }
}
