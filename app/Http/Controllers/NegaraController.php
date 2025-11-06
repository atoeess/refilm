<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NegaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $negaras = Negara::all();

        return view('negara.index', compact('negaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('negara.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_negara' => 'required',
        ]);

        Negara::create([
            'nama_negara' => $request->nama_negara,
            'slug' => Str::slug($request->nama_negara)

        ]);

        return redirect()->route('negara.index')->with('success', 'Sukses menambahkan data negara');
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
        $negara = Negara::findOrFail($id);
        return view('negara.edit', compact('negara'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_negara' => 'required',
        ]);

        $negara = Negara::findOrFail($id);

        $negara->update([
            'nama_negara' => $request->nama_negara,
            'slug' => Str::slug($request->nama_negara),
        ]);

        return redirect()->route('negara.index')->with('success', 'Data negara berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $negara = Negara::findOrFail($id);
        $negara->delete();

        return redirect()->route('negara.index')->with('success', 'Data negara berhasil dihapus');
    }
}
