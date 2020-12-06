<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Withdrawal extends Model
{
    protected $fillable = ['id_petshop', 'tanggal_pengajuan', 'jml_penarikan', 'tanggal_pencairan', 'status', 'bukti', 'bank', 'nama_rekening', 'no_rekening'];

    public function takeImage()
    {
        return "/storage/" . $this->bukti;
    }
}
