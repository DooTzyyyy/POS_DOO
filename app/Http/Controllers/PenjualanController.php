<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar transaksi penjualan.
     */
    public function index(): View
    {
        $sales = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->latest()
        ->paginate(10);

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Menampilkan form transaksi baru.
     */
    public function create(): View
    {
        $produk = Produk::all();

        return view('penjualan.create', compact('produk'));
    }

    /**
     * Menyimpan transaksi penjualan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        try {

            DB::transaction(function () use ($validated) {

                // Ambil produk dan kunci baris selama transaksi
                $produk = Produk::where('id', $validated['produk_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                // Cek stok
                if ($produk->stok < $validated['jumlah']) {
                    throw new \Exception(
                        'Stok produk tidak mencukupi. Stok tersedia: ' . $produk->stok
                    );
                }

                // Gunakan harga jual
                $harga = $produk->harga_jual;

                // Hitung subtotal
                $subtotal = $harga * $validated['jumlah'];

                // Simpan transaksi utama
                $penjualan = Penjualan::create([
                    'user_id' => auth()->id(),
                    'total_pembayaran' => $subtotal,
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'status' => 'COMPLETED',
                ]);

                // Simpan detail transaksi
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produk->id,
                    'kuantitas' => $validated['jumlah'],
                    'harga_satuan' => $harga,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok
                $produk->decrement('stok', $validated['jumlah']);
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Menampilkan detail transaksi.
     */
    public function show(Penjualan $penjualan): View
    {
        $penjualan->load([
            'user',
            'itemPenjualan.produk'
        ]);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Menampilkan form edit transaksi.
     */
    public function edit(Penjualan $penjualan): View
    {
        $produk = Produk::all();

        $penjualan->load([
            'itemPenjualan.produk'
        ]);

        return view('penjualan.pos', compact(
            'penjualan',
            'produk'
        ));
    }

    /**
     * Memperbarui transaksi.
     */
    public function update(
        Request $request,
        Penjualan $penjualan
    ): RedirectResponse {

        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        try {

            DB::transaction(function () use ($validated, $penjualan) {

                // Ambil item lama
                $itemLama = $penjualan->itemPenjualan()->first();

                if (!$itemLama) {
                    throw new \Exception(
                        'Detail transaksi tidak ditemukan.'
                    );
                }

                // Kembalikan stok produk lama
                $produkLama = Produk::where('id', $itemLama->produk_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $produkLama->increment(
                    'stok',
                    $itemLama->kuantitas
                );

                // Ambil produk baru
                $produkBaru = Produk::where('id', $validated['produk_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                // Cek stok
                if ($produkBaru->stok < $validated['jumlah']) {
                    throw new \Exception(
                        'Stok produk tidak mencukupi. Stok tersedia: '
                        . $produkBaru->stok
                    );
                }

                // Harga jual terbaru
                $harga = $produkBaru->harga_jual;

                // Hitung subtotal
                $subtotal = $harga * $validated['jumlah'];

                // Update transaksi
                $penjualan->update([
                    'total_pembayaran' => $subtotal,
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                ]);

                // Update detail transaksi
                $itemLama->update([
                    'produk_id' => $produkBaru->id,
                    'kuantitas' => $validated['jumlah'],
                    'harga_satuan' => $harga,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok produk baru
                $produkBaru->decrement(
                    'stok',
                    $validated['jumlah']
                );
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi.
     */
    public function destroy(Penjualan $penjualan): RedirectResponse
    {
        try {

            DB::transaction(function () use ($penjualan) {

                // Kembalikan stok setiap produk
                foreach ($penjualan->itemPenjualan as $item) {

                    $produk = Produk::find($item->produk_id);

                    if ($produk) {
                        $produk->increment(
                            'stok',
                            $item->kuantitas
                        );
                    }
                }

                // Hapus detail transaksi
                $penjualan->itemPenjualan()->delete();

                // Hapus transaksi
                $penjualan->delete();
            });

        } catch (\Exception $e) {

            return back()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
