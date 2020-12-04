<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = ['judul', 'slug', 'ulasan', 'gambar', 'tanggal'];
    protected $with = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function takeImage()
    {
        return "/storage/" . $this->gambar;
    }
}
