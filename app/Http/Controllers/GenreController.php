<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_genre' => 'required',
        ]);

        Genre::create([
            'nama_genre' => $request->nama_genre,
            'slug' => Str::slug($request->nama_genre)

        ]);

        return redirect()->route('genre.index')->with('success','Sukses menambahkan data genre');
    }

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
    public function edit(string $id)
    {
        $genres = Genre::findOrFail($id);
        return view('genre.edit', compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_genre' => 'required',
        ]);

        $genres = Genre::findOrFail($id);

        $genres->update([
            'nama_genre' => $request->nama_genre,
            'slug' => Str::slug($request->nama_genre),
        ]);

        return redirect()->route('genre.index')->with('success', 'Data genre berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genres = Genre::findOrFail($id);
        $genres->delete();

        return redirect()->route('genre.index')->with('success', 'Data genre berhasil dihapus');
    }
}
