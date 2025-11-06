<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    protected $table = 'negara';

    protected $fillable = [
        "nama_negara", "slug"
    ];

    public function film()
    {
        return $this->hasMany(Film::class);
    }
}

