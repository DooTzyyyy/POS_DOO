<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['user', 'jenis']);

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $produks = $query->latest()->paginate(10);

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $jenises = Jenis::orderBy('nama')->get();

        return view('produk.create', compact('jenises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis,id',
            'nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'jenis_id',
            'nama',
            'harga_beli',
            'harga_jual',
            'stok'
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // Menggunakan Route Model Binding (Produk $produk) agar lebih bersih
    public function edit(Produk $produk)
    {
        $jenises = Jenis::orderBy('nama')->get();

        return view('produk.edit', compact('produk', 'jenises'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis,id',
            'nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'jenis_id',
            'nama',
            'harga_beli',
            'harga_jual',
            'stok'
        ]);

        // 🔥 PERBAIKAN: user_id tidak diubah saat update agar pembuat asli produk tetap tercatat

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Produk $produk)
    {
        // 🔥 PERBAIKAN UTAMA: Cegah hapus jika produk sudah ada di riwayat transaksi (Mencegah Error 1451)
        if ($produk->itemPenjualan()->exists()) {
            return redirect()->route('produk.index')
                ->with('error', 'Produk tidak bisa dihapus karena terdapat pada riwayat transaksi.');
        }

        // Hapus foto dari storage jika ada
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function show(Produk $produk)
    {
        // Load relasi user & jenis untuk detail produk
        $produk->load(['user', 'jenis']);

        return view('produk.show', compact('produk'));
    }
}
