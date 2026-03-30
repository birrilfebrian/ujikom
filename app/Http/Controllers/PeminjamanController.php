<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjamans;
use App\Models\Anggotas;
use App\Models\Bukus;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjamans::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $anggotas = Anggotas::all();
        $bukus = Bukus::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('anggotas', 'bukus'));
    }

    public function show($id)
    {
        $peminjaman = Peminjamans::with(['anggota', 'buku'])->findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string',
            'buku_id' => 'required|exists:bukus,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_deadline' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $anggota = Anggotas::firstOrCreate(
            ['nama' => $request->nama_anggota],
            [
                'alamat' => 'Alamat belum dilengkapi'
            ]
        );

        $buku = Bukus::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        Peminjamans::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $request->buku_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali_deadline' => $request->tgl_kembali_deadline,
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjamans::findOrFail($id);

        if ($peminjaman->status == 'kembali') {
            return redirect()->back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        $tgl_sekarang = date('Y-m-d');
        $status = ($tgl_sekarang > $peminjaman->tgl_kembali_deadline) ? 'terlambat' : 'kembali';

        $peminjaman->update([
            'tgl_kembali_aktual' => $tgl_sekarang,
            'status' => $status
        ]);
        $peminjaman->buku->increment('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan. Status: ' . ucfirst($status));
    }
}
