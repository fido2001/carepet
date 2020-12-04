<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'noHp', 'alamat', 'id_role', 'saldo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->count() == 1;
    }

    public function dataproduk()
    {
        return $this->belongsToMany(DataProduk::class, 'ordering_medicine_food', 'produk_id', 'user_id');
    }

    public function datapaket()
    {
        return $this->belongsToMany(Paket::class, 'ordering_service_packages', 'paket_id', 'user_id');
    }

    public function article()
    {
        return $this->hasMany(Article::class, 'user_id');
    }
}
