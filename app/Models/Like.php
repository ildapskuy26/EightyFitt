<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'berita_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
