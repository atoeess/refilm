<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_film' => 'required|exists:film,id',
            'nilai_rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::updateOrCreate(
            [
                'id_user' => Auth::id(),
                'id_film' => $request->id_film,
            ],
            [
                'nilai_rating' => $request->nilai_rating
            ]
        );

        return response()->json([
            'success' => true,
            'average' => $rating->film->averageRating()
        ]);
    }

    // Menampilkan semua film yang punya rating
    public function index()
    {
        $films = Film::withCount('ratings')
            ->orderBy('ratings_count', 'desc')
            ->get();

        return view('rating.index', compact('films'));
    }

    // Menampilkan semua rating dari 1 film
   public function show($id)
{
    $film = Film::findOrFail($id);

    $ratings = Rating::where('id_film', $id)
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('rating.show', compact('film', 'ratings'));
}

}
