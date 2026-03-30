<?php

namespace App\Http\Controllers;

use App\Models\Bukus as Buku;
use App\Models\Penulis;
use App\Models\Kategoris;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function index()
    {
        $bukus = Buku::with(['penulis', 'kategoris'])
            ->latest()
            ->paginate(10);
        return view('admin.buku.index', compact('bukus'));
    }


    public function create()
    {
        $penulis = Penulis::all();
        $kategoris = Kategoris::all();
        return view('admin.buku.create', compact('penulis', 'kategoris'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis_id' => 'required',
            'stok' => 'required|numeric|min:1',
            'kategori_id' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4|min:1901|max:2155',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $penulis = Penulis::all();
        $kategoris = Kategoris::all();

        return view('admin.buku.edit', compact('buku', 'penulis', 'kategoris'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'penulis_id' => 'required|string',
            'stok' => 'required|numeric',
            'kategori_id' => 'required|string',
            'tahun_terbit' => 'required|numeric',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    public function getPenulis() {}
}
