<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Negara;
use App\Models\Highlight;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $films = Film::withAvg('ratings', 'nilai_rating')->get();

        // 🔥 Favorite user
        $favoritesUserIds = Favorite::where('id_user', Auth::id())
            ->pluck('id_film')
            ->toArray();

        // 🔥 Dropdown tahun
        $tahuns = Film::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->get();

        return view('home', [
            'genres' => Genre::all(),
            'negaras' => Negara::all(),
            'tahuns' => $tahuns, // ⬅️ DITAMBAHKAN

            'highlights' => Highlight::with('film')->latest()->get(),

            'films' => $films,
            'filmsSemua' => $films,
            'filmsPopuler' => Film::withAvg('ratings', 'nilai_rating')
                ->orderByDesc('ratings_avg_nilai_rating')
                ->get(),

            'filmsBaru' => Film::withAvg('ratings', 'nilai_rating')
                ->orderByDesc('tahun')
                ->get(),

            'favoritesUserIds' => $favoritesUserIds
        ]);
    }


    public function rekomendasi(Request $request)
    {
        $tab = $request->query('tab', 'semua');

        if ($tab === 'populer') {
            $films = Film::withCount('ratings')
                ->withAvg('ratings', 'nilai_rating')
                ->orderBy('ratings_count', 'desc')
                ->paginate(12);
        } elseif ($tab === 'baru') {
            $films = Film::withAvg('ratings', 'nilai_rating')
                ->orderBy('tanggal_rilis', 'desc')
                ->paginate(12);
        } else {
            $films = Film::withAvg('ratings', 'nilai_rating')
                ->withCount('ratings')
                ->paginate(12);
        }

        $filmsPopuler = Film::withCount('ratings')
            ->withAvg('ratings', 'nilai_rating')
            ->orderBy('ratings_count', 'desc')
            ->take(30)
            ->get();

        $filmsBaru = Film::withAvg('ratings', 'nilai_rating')
            ->orderBy('tanggal_rilis', 'desc')
            ->take(30)
            ->get();

        $filmsSemua = Film::withAvg('ratings', 'nilai_rating')
            ->withCount('ratings')
            ->take(30)
            ->get();

        $favoritesUserIds = Favorite::where('id_user', Auth::id())
            ->pluck('id_film')
            ->toArray();

        return view('rekomendasi', [
            'films' => $films,
            'filmsSemua' => $filmsSemua,
            'filmsPopuler' => $filmsPopuler,
            'filmsBaru' => $filmsBaru,
            'tab' => $tab,
            'favoritesUserIds' => $favoritesUserIds
        ]);
    }









    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
