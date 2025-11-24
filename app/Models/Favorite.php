<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['id_user', 'id_film'];

    public function film()
{
    return $this->belongsTo(Film::class, 'id_film');
}

}
