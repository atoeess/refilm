<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $fillable = [
        'id_user',
        'id_film',
        'isi_komentar'
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
