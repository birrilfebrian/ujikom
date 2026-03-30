<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategoris;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategoris::withCount('bukus')
            ->latest()
            ->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }


    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategoris::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = kategoris::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategoris = kategoris::findOrFail($id);
        $kategoris->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Data kategoris berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $data = Kategoris::findOrFail($id);
        $data->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
