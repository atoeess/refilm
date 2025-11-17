<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Komentar;
use App\Models\Negara;
use App\Models\Rating;
use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    /**
     * LIST FILM
     */
    public function index()
    {
        $films = Film::with(['genres', 'negara'])->paginate(10);
        return view('film.index', compact('films'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $genres  = Genre::all();
        $negaras = Negara::all();

        return view('film.create', compact('genres', 'negaras'));
    }

    /**
     * SIMPAN FILM BARU
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

        // upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->storeAs('public/fotos', $filename);
            $fotoPath = $filename;
        }

        // simpan film
        $film = Film::create([
            'foto'      => $fotoPath,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tahun'     => $request->tahun,
            'id_negara' => $request->negara,
            'sinopsis'  => $request->sinopsis,
            'trailer'   => $request->trailer,
            'slug'      => Str::slug($request->judul),
        ]);

        // relasi genre
        $film->genres()->attach($request->genre);

        return redirect()->route('film.index')
            ->with('success', 'Sukses menambahkan data film');
    }

    /**
     * DETAIL FILM
     */
    public function show($slug)
    {
        $film = Film::with(['genres', 'negara'])
            ->where('slug', $slug)
            ->firstOrFail();

        $komentars = Komentar::with('user')
            ->where('id_film', $film->id)
            ->latest()
            ->get();

        $highlights = Highlight::where('id_film', $film->id)->get();

        return view('film.detail', compact('film', 'komentars', 'highlights'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $film    = Film::with(['genres', 'negara'])->findOrFail($id);
        $genres  = Genre::all();
        $negaras = Negara::all();

        return view('film.edit', compact('film', 'genres', 'negaras'));
    }

    /**
     * UPDATE FILM
     */
    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'genre' => 'required|array|exists:genres,id',
            'negara' => 'required',
            'sinopsis' => 'nullable',
            'trailer' => 'nullable',
        ]);

        // handle foto
        if ($request->hasFile('foto')) {
            if ($film->foto && Storage::exists('public/fotos/' . $film->foto)) {
                Storage::delete('public/fotos/' . $film->foto);
            }

            $filename = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->storeAs('public/fotos', $filename);
            $film->foto = $filename;
        }

        // update data
        $film->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tahun'     => $request->tahun,
            'sinopsis'  => $request->sinopsis,
            'trailer'   => $request->trailer,
            'id_negara' => $request->negara,
        ]);

        // sync relasi genre
        $film->genres()->sync($request->genre);

        return redirect()->route('film.index')
            ->with('success', 'Data film berhasil diupdate!');
    }

    /**
     * HAPUS FILM
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);

        if ($film->foto && Storage::exists('public/fotos/' . $film->foto)) {
            Storage::delete('public/fotos/' . $film->foto);
        }

        $film->delete();

        return redirect()->route('film.index')
            ->with('success', 'Data film berhasil dihapus');
    }

    /**
     * SEARCH
     */
    public function search(Request $request)
    {
        $query = $request->q;

        $films = Film::with(['genres', 'negara'])
            ->where('judul', 'like', "%{$query}%")
            ->get();

        return view('film.search', compact('films', 'query'));
    }

    /**
     * RATING FILM
     */
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
                'nilai_rating' => $request->rating,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil disimpan',
            'average' => Rating::where('id_film', $request->film_id)->avg('nilai_rating'),
        ]);
    }


    public function byGenre($id)
    {
        $genre = Genre::findOrFail($id);

        // Ambil semua film yang punya genre ini
        $films = Film::whereHas('genres', function ($q) use ($id) {
            $q->where('genres.id', $id);
        })->paginate(12);

        $genres = Genre::all();
        $negaras = Negara::all();

        return view('film.genre', compact('films', 'genre', 'genres', 'negaras'));
    }


    public function byNegara($id)
    {
        $negara = Negara::findOrFail($id);

        $films = Film::where('id_negara', $id)->paginate(12);

        $genres = Genre::all();
        $negaras = Negara::all();

        return view('film.negara', compact('films', 'negara', 'genres', 'negaras'));
    }
}
