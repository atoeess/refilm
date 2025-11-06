<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    protected $table = "film";
    protected $fillable = [
        "foto",
        "judul",
        "deskripsi",
        "id_genre",
        "tahun",
        "id_negara",
        "sinopsis",
        "trailer",
        "slug"
    ];

     public static function boot()
    {
        parent::boot();

        static::creating(function ($film) {
            $film->slug = Str::slug($film->judul, '-');
        });
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'id_film', 'id_genre');
    }

    public function negara()
    {
        return $this->belongsTo(Negara::class, 'id_negara');
    }
}
