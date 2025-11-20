<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Negara;
use App\Models\Highlight;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::withAvg('ratings', 'nilai_rating')->get();

        return view('home', [
            'genres' => Genre::all(),
            'negaras' => Negara::all(),
            'highlights' => Highlight::with('film')->latest()->get(),

            'films' => $films,
            'filmsSemua' => $films,   // ⭐ perbaikan di sini
            'filmsPopuler' => Film::withAvg('ratings', 'nilai_rating')
                ->orderByDesc('ratings_avg_nilai_rating')
                ->get(),

            'filmsBaru' => Film::withAvg('ratings', 'nilai_rating')
                ->orderByDesc('tahun')
                ->get(),
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

        // 🔹 Data untuk Alpine (tanpa pagination)
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

        return view('rekomendasi', [
            'films' => $films,           // dipakai server-side
            'filmsSemua' => $filmsSemua, // 🔥 FIX WAJIB
            'filmsPopuler' => $filmsPopuler,
            'filmsBaru' => $filmsBaru,
            'tab' => $tab
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
