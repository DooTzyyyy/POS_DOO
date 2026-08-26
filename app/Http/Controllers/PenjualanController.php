<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar transaksi penjualan.
     */
    public function index(): View
    {
        $sales = Penjualan::with('user')
            ->latest()
            ->paginate(10);

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Menampilkan form untuk membuat transaksi baru.
     */
    public function create(): View
    {
        $produk = Produk::all();

        return view('penjualan.create', compact('produk'));
    }

    /**
     * Menyimpan transaksi penjualan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi dasar (sesuaikan dengan input form Anda nanti)
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        // Logika simpan data Anda di sini...

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Menampilkan detail dari satu transaksi penjualan.
     */
    public function show(Penjualan $penjualan): View
    {
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Menampilkan form untuk mengubah data transaksi.
     */
    public function edit(Penjualan $penjualan): View
    {
        // Menggunakan view 'pos' jika halaman edit Anda digabung ke kasir, 
        // atau ubah ke 'penjualan.edit' jika Anda membuat file edit.blade.php terpisah.
        return view('penjualan.pos', compact('penjualan')); 
    }

    /**
     * Memperbarui data transaksi di database.
     */
    public function update(Request $request, Penjualan $penjualan): RedirectResponse
    {
        // Logika update data Anda di sini...

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus data transaksi dari database.
     */
    public function destroy(Penjualan $penjualan): RedirectResponse
    {
        $penjualan->delete();

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
