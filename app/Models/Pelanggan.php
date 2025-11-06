<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
