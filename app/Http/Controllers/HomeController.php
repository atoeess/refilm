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
        return view('home', [
            'genres' => Genre::all(),
            'negaras' => Negara::all(),
            'highlights' => Highlight::with('film')->latest()->get(),

            // Film untuk grid biasa
            'film' => Film::select('id', 'judul', 'slug', 'foto', 'deskripsi')->get(),

            // Film untuk tab "Semua"
            'films' => Film::select('id', 'judul', 'slug', 'foto', 'deskripsi')->get(),

            // Film untuk tab "Populer"
            'filmsPopuler' => Film::withCount('ratings')
                ->orderBy('ratings_count', 'desc')
                ->get(),

            // Film untuk tab "Baru" — sort dari tahun terbaru
            'filmsBaru' => Film::orderBy('tahun', 'desc')->get(),
        ]);
    }



    public function rekomendasi(Request $request)
    {
        $tab = $request->query('tab', 'semua');

        if ($tab === 'populer') {
            $films = Film::withCount('ratings')
                ->orderBy('ratings_count', 'desc')
                ->paginate(12);
        } elseif ($tab === 'baru') {
            $films = Film::orderBy('tanggal_rilis', 'desc')->paginate(12);
        } else {
            $films = Film::paginate(12);
        }

        return view('rekomendasi', [
            'films' => $films,
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
