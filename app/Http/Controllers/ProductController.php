<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $pelanggans = Pelanggan::with(['user'])->paginate(10);

        return view('product.index', compact('products', 'pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Ini Validasinya
            $request->validate([
                'nama' => 'required',
                'deskripsi' => 'required'
            ], [
                'nama' => 'Nama Wajib Diisi',
                "deskripsi" => "Deskripsi Produk Wajib Diisi"
            ]);

            // Cara Nyimpannya
            Product::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi
            ]);

            $user = User::create([
                'name' => $request->nama_pelanggan,
                'email' => $request->email,
                'password' => $request->password
            ]);

            Pelanggan::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'user_id' => $user->id
            ]);

            return redirect()->route('product.index')->with('success', 'Produk Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) {
            return redirect()->route('product.index')->with('error', 'Data Pelanggan tidak ditemukan');
        }

        $users = User::all();

        return view('product.edit', compact('pelanggan', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pelanggan = Pelanggan::find($id);
            // Ini Validasinya
            $request->validate([
                'nama_pelanggan' => 'required',
                'alamat' => 'required'
            ], [
                'nama_pelanggan' => 'Nama pelanggan Wajib Diisi',
                "alamat" => "alamat Wajib Diisi"
            ]);

            $pelanggan->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'user_id' => $request->user_id
            ]);

            return redirect()->route('product.index')->with('success', 'Produk Berhasil Diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
