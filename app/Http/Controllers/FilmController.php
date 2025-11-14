<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Komentar;
use App\Models\Negara;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::with(['genres', 'negara'])->paginate(10);

        return view('film.index', compact('films'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $negaras = Negara::all();
        return view('film.create', compact('genres', 'negaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required',
            'deskripsi' => 'required',
            'genre' => 'required|array|exists:genres,id',
            'tahun' => 'required',
            'negara' => 'required',
            'sinopsis' => 'required',
            'trailer' => 'required',
        ]);

        $filename = null;

        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('public/fotos', $filename);
            $fotoPath = $filename;
        } else {
            $fotoPath = null;
        }

        // Simpan data film
        $film = Film::create([
            'foto' => $fotoPath ?? null, // simpan nama file, bukan path sementara
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tahun' => $request->tahun,
            'id_negara' => $request->negara,
            'sinopsis' => $request->sinopsis,
            'trailer' => $request->trailer,
            'slug' => Str::slug($request->judul),
        ]);

        // Simpan relasi genre
        $film->genres()->attach($request->genre);

        return redirect()->route('film.index')->with('success', 'Sukses menambahkan data film');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $film = Film::with(['genres', 'negara'])->where('slug', $slug)->firstOrFail();
        $komentars = Komentar::with('user')->where('id_film', $film->id)->get();

        return view('film.detail', compact('film', 'komentars'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $films = Film::findOrFail($id);

        // Ambil film beserta genre yang sudah terkait
        $films = Film::with('genres')->findOrFail($id);
        $films = Film::with('negara')->findOrFail($id);


        $genres = Genre::all();
        $negaras = Negara::all();
        return view('film.edit', compact('films', 'genres', 'negaras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'genre' => 'required|array',
            'negara' => 'required',
            'sinopsis' => 'nullable',
            'trailer' => 'nullable',
        ]);

        if ($request->hasFile('foto')) {
            if ($film->foto && Storage::exists('public/fotos/' . $film->foto)) {
                Storage::delete('public/fotos/' . $film->foto);
            }

            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('public/fotos', $filename);
            $film->foto = $filename;
        }

        // Update field biasa
        $film->judul = $request->judul;
        $film->deskripsi = $request->deskripsi;
        $film->tahun = $request->tahun;
        $film->sinopsis = $request->sinopsis;
        $film->trailer = $request->trailer;
        $film->id_negara = $request->negara;
        $film->save();

        // Update relasi many-to-many (film_genre)
        $film->genres()->sync($request->genre);

        return redirect()->route('film.index')->with('success', 'Data film berhasil diupdate!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $films = Film::findOrFail($id);
        $films->delete();

        return redirect()->route('film.index')->with('success', 'Data film berhasil dihapus');
    }


    public function showByGenre($id)
    {
        $genre = Genre::findOrFail($id);
        $films = Film::where('genre_id', $id)->get();

        return view('genre.index', compact('genre', 'films'));
    }


    public function showByNegara($id)
    {
        $genre = Negara::findOrFail($id);
        $films = Film::where('negara_id', $id)->get();

        return view('negara.index', compact('negara', 'films'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        // cari semua film yang judulnya mengandung keyword + load relasi genre & negara
        $films = \App\Models\Film::with(['genres', 'negara'])
            ->where('judul', 'like', "%{$query}%")
            ->get();

        return view('film.search', compact('films', 'query'));
    }


    public function rating(Request $request)
{
    $request->validate([
        'film_id' => 'required',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Rating::updateOrCreate(
        [
            'id_user' => auth()->id(),
            'id_film' => $request->film_id,
        ],
        [
            'rating' => $request->rating,
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Rating berhasil disimpan',
        'average' => Rating::where('id_film', $request->film_id)->avg('nilai_rating')
    ]);
}

}
