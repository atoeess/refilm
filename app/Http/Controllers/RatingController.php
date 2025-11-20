<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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
}
