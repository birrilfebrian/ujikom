<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;

class PenulisController extends Controller
{
     public function index()
    {
        $penulises = Penulis::all();
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
}
