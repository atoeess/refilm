<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Film;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::with('film')->get();
        return view('highlight.index', compact('highlights'));
    }

    public function create()
    {
        $films = Film::all();
        return view('highlight.create', compact('films'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tagline' => 'nullable|string|max:255',
            'id_film' => 'required|exists:films,id',
            'kategori' => 'nullable|string|max:100',
        ]);

        // Simpan thumbnail di folder storage/app/public/thumbnails
        $path = $request->file('thumbnail')->store('thumbnails', 'public');

        Highlight::create([
            'thumbnail' => $path, // simpan full path relatif
            'tagline' => $request->tagline,
            'id_film' => $request->id_film,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('highlight.index')->with('success', 'Highlight berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $highlight = Highlight::findOrFail($id);
        $films = Film::all();
        return view('highlight.edit', compact('highlight', 'films'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048',
            'tagline' => 'required|string|max:255',
            'id_film' => 'required|exists:film,id',
            'kategori' => 'required|string|max:255',
        ]);

        $highlight = Highlight::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            // Simpan thumbnail baru di folder yang sama
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $highlight->thumbnail = $path;
        }

        $highlight->tagline = $request->tagline;
        $highlight->id_film = $request->id_film;
        $highlight->kategori = $request->kategori;
        $highlight->save();

        return redirect()->route('highlight.index')->with('success', 'Highlight berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);
        $highlight->delete();
        return redirect()->route('highlight.index')->with('success', 'Data highlight berhasil dihapus');
    }
}
