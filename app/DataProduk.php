<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'ordering_medicine_food');
    }
}
