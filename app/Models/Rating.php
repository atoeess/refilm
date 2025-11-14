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

    public function films()
    {
        return $this->belongsToMany(Film::class, 'id_film');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'id_user');
    }

    public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function averageRating()
{
    return $this->ratings()->avg('rating') ?? 0;
}

}
