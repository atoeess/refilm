<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = ['id_film', 'thumbnail', 'tagline', 'kategori'];

    // $table biarkan default = 'highlights'
    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }
}


