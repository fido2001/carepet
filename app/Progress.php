<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress_hewan';

    protected $fillable = ['id_service', 'hari_ke', 'kondisi_hewan', 'foto'];

    public function order()
    {
        return $this->hasMany(PaketUser::class, 'id_service');
    }

    public function takeImage()
    {
        return "/storage/" . $this->foto;
    }
}
