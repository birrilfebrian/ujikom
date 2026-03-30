<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggotas;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggotas::withCount('peminjamans')
            ->latest()
            ->paginate(10);
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function edit($id)
    {
        $anggota = Anggotas::findOrFail($id);

        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:anggotas,nama,' . $id,
            'alamat' => 'required|string|min:5',
        ]);

        $anggota = Anggotas::findOrFail($id);
        $anggota->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota "' . $anggota->nama . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Anggotas::findOrFail($id);

        $masihPinjam = $data->peminjamans()
            ->whereIn('status', ['dipinjam'])
            ->exists();

        if ($masihPinjam) {
            return redirect()->route('anggota.index')
                ->with('error', 'Gagal! Anggota ini masih memiliki buku yang belum dikembalikan.');
        }
        $data->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
