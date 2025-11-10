<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class UserFilmController extends Controller
{
    public function show($slug)
    {
        $film = Film::with(['genres', 'negara'])->where('slug', $slug)->firstOrFail();
        return view('film.detail', compact('film'));
    }
}
