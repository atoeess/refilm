<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    // INDEX — list data tahun
    public function index()
    {
        $tahuns = Tahun::orderBy('tahun', 'desc')->get();

        return view('tahun.index', compact('tahuns'));
    }

    // CREATE — form tambah
    public function create()
    {
        return view('tahun.create');
    }

    // STORE — simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|unique:tahuns,tahun'
        ]);

        Tahun::create([
            'tahun' => $request->tahun
        ]);

        return redirect()->route('tahun.index')->with('success', 'Tahun berhasil ditambahkan!');
    }

    // EDIT — form edit
    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);

        return view('tahun.edit', compact('tahun'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|integer|unique:tahuns,tahun,' . $id
        ]);

        $tahun = Tahun::findOrFail($id);
        $tahun->update([
            'tahun' => $request->tahun
        ]);

        return redirect()->route('tahun.index')->with('success', 'Tahun berhasil diupdate!');
    }

    // DELETE
    public function destroy($id)
    {
        Tahun::findOrFail($id)->delete();

        return redirect()->route('tahun.index')->with('success', 'Tahun berhasil dihapus!');
    }
}
