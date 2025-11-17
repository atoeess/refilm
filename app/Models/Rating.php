<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id_user',
        'id_film',
        'nilai_rating'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
