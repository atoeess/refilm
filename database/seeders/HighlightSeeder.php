<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Highlight;
use App\Models\Film;

class HighlightSeeder extends Seeder
{
    public function run(): void
    {
        $film = Film::first();
        if ($film) {
            Highlight::create([
                'id_film' => $film->id,
                'tagline' => 'Film Populer Tahun Ini',
                'is_active' => true,
            ]);
        }
    }
}

