<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_highlight';


    protected $fillable = [
        'thumbnail',
        'tagline',
        'id_film',
        'kategori',
    ];


    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }
}
