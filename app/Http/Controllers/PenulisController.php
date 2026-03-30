<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;

class PenulisController extends Controller
{
    public function index()
    {
        $penulises = Penulis::withCount('bukus')
            ->latest()
            ->paginate(10);
        return view('admin.penulis.index', compact('penulises'));
    }

    public function create()
    {

        return view('admin.penulis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penulis' => 'required|string|max:255',
            'biografi' => 'nullable|string',
        ]);

        Penulis::create($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil didaftarkan!');
    }

    public function edit($id)
    {
        $penulis = Penulis::findOrFail($id);

        return view('admin.penulis.edit', compact('penulis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penulis' => 'required|string',
            'biografi' => 'required|string',
        ]);

        $Penulis = Penulis::findOrFail($id);
        $Penulis->update($request->all());

        return redirect()->route('penulis.index')
            ->with('success', 'Data penulis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Penulis::findOrFail($id);
        $data->delete();

        return redirect()->route('penulis.index')
            ->with('success', 'penulis berhasil dihapus.');
    }
}
