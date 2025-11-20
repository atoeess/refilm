<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
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

    // Pastikan hanya pemilik komentar yang bisa menghapus
    if ($komentar->id_user!== auth()->id()) {
        abort(403, 'Tidak memiliki izin.');
    }

    $komentar->delete();

    return back()->with('success', 'Komentar berhasil dihapus.');
}

}
