<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('id_user', Auth::id())
            ->with('film') // pastikan relasi film() ada
            ->get();

        return view('favorite.index', [
            'favorites' => $favorites
        ]);
    }


    public function toggle(Request $request)
    {
        $idFilm = $request->id_film;

        $favorite = Favorite::where('id_user', Auth::id())
            ->where('id_film', $idFilm)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['favorite' => false]);
        } else {
            Favorite::create([
                'id_user' => Auth::id(),
                'id_film' => $idFilm
            ]);
            return response()->json(['favorite' => true]);
        }
    }
}
