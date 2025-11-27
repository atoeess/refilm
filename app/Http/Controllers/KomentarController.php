<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // daftar film + jumlah komentar
        $films = Film::withCount('komentars')->get();

        return view('komentar.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Komentar::create([
            'id_film' => $request->id_film,
            'id_user' => Auth::user()->id,
            'isi_komentar' => $request->isi_komentar
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan komentar');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);

        $komentars = Komentar::where('id_film', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('komentar.show', [
            'film' => $film,
            'komentars' => $komentars
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $komentar = Komentar::findOrFail($id);

    // Jika user admin → bisa hapus apa saja
    if (auth()->user()->role === 'admin') {
        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus (admin).');
    }

    // Jika user biasa → hanya boleh hapus komentarnya sendiri
    if ($komentar->id_user !== auth()->id()) {
        return redirect()->back()->with('error', 'Kamu tidak punya izin menghapus komentar ini.');
    }

    $komentar->delete();
    return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
}

}
