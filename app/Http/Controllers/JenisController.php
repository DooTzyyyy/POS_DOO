<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        $query = Jenis::query();

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $jenises = $query->latest()->paginate(10);

        return view('jenis.index', compact('jenises'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Jenis::create($request->only('nama'));

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis berhasil ditambahkan');
    }

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jenis->update($request->only('nama'));

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis berhasil diupdate');
    }

    public function destroy($jeni)
    {
        $jenis = \App\Models\Jenis::find($jeni);

        if (!$jenis) {
            return redirect()
                ->route('jenis.index')
                ->with('error', 'Data jenis tidak ditemukan.');
        }

        $jenis->delete();

        return redirect()
            ->route('jenis.index')
            ->with('success', 'Jenis berhasil dihapus.');
    }
}
