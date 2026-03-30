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
        $bukus = Buku::all();
        return view('admin.buku.index', compact('bukus'));
    }


    public function create()
    {
        $penulis = Penulis::all();
        $kategoris = Kategoris::all();
        return view('admin.buku.create',compact('penulis','kategoris'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis_id' => 'required',
            'stok' => 'required|numeric',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }


    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'stok' => 'required|numeric',
        ]);

        $buku->update($request->all());

        return redirect()->route('.buku.index')
                         ->with('success', 'Data buku berhasil diperbarui.');
    }


    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil dihapus.');
    }
    
    public function getPenulis(){

    }
}