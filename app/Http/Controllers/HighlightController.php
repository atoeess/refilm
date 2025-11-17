<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $highlights = Highlight::with('film')->get();
        return view('highlight.index', compact('highlights'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = Film::all();
        return view('highlight.create', compact('films'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tagline' => 'nullable|string|max:255',
            'id_film' => 'required|exists:film,id',
            'kategori' => 'nullable|string|max:100',
        ]);

        $path = $request->file('thumbnail')->store('thumbnails', 'public');

        Highlight::create([
            'thumbnail' => $path,
            'tagline' => $request->tagline,
            'id_film' => $request->id_film,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('highlight.index')->with('success', 'Highlight berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit($id)
    {
        $highlight = Highlight::findOrFail($id);
        $films = Film::all();

        return view('highlight.edit', compact('highlight', 'films'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048',
            'tagline' => 'required|string|max:255',
            'id_film' => 'required|exists:film,id',
            'kategori' => 'required|string|max:255',
        ]);

        $highlight = Highlight::findOrFail($id);

        // Kalau upload thumbnail baru
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->storeAs('public/thumbnails', $thumbnailName);
            $highlight->thumbnail = $thumbnailName;
        }

        $highlight->tagline = $request->tagline;
        $highlight->id_film = $request->id_film;
        $highlight->kategori = $request->kategori;
        $highlight->save();

        return redirect()->route('highlight.index')->with('success', 'Highlight berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);
        $highlight->delete();

        return redirect()->route('highlight.index')->with('success', 'Data highlight berhasil dihapus');
    }

    
}
