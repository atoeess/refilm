<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = [
        "nama_genre",
        "slug"
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_genre', 'id_genre', 'id_film');
    }
}
