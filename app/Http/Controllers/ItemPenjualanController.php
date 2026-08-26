<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ItemPenjualanController extends Controller
{
    public function index()
    {
        $items = ItemPenjualan::all();
        return view('itempenjualan.index', compact('items'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('itempenjualan.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric',
        ]);

        ItemPenjualan::create($request->all());

        return redirect()->route('itempenjualan.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $item = ItemPenjualan::findOrFail($id);

        return view('itempenjualan.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = ItemPenjualan::findOrFail($id);
        $produk = Produk::all();

        return view('itempenjualan.edit', compact('item', 'produk'));
    }

    public function update(Request $request, string $id)
    {
        $item = ItemPenjualan::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('itempenjualan.index')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id)
    {
        ItemPenjualan::destroy($id);

        return redirect()->route('itempenjualan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
