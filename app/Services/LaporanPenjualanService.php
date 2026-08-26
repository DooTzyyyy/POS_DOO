<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanService
{
    public function ringkasanHariIni(): array
    {
        $data = DB::table('penjualan')
    ->selectRaw('
        COUNT(*) as total_transaksi,
        SUM(total_pembayaran) as total_penjualan,
        SUM(CASE 
            WHEN LOWER(TRIM(metode_pembayaran)) IN ("tunai","cash") 
            THEN total_pembayaran ELSE 0 
        END) as total_cash,
        SUM(CASE 
            WHEN LOWER(TRIM(metode_pembayaran)) NOT IN ("tunai","cash") 
            THEN total_pembayaran ELSE 0 
        END) as total_non_tunai
    ')
    ->first();

        return [
            'total_transaksi' => $data->total_transaksi ?? 0,
            'total_penjualan' => $data->total_penjualan ?? 0,
            'total_cash' => $data->total_cash ?? 0,
            'total_non_tunai' => $data->total_non_tunai ?? 0,
        ];
    }

    public function produkTerlarisHariIni(int $limit = 5)
{
    return DB::table('item_penjualan')
        ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
        ->groupBy('produk.id', 'produk.nama', 'produk.stok')
        ->select(
            'produk.nama',
            'produk.stok',
            DB::raw('COALESCE(SUM(item_penjualan.kuantitas),0) as total_terjual')
        )
        ->orderByDesc('total_terjual')
        ->limit($limit)
        ->get();
}
}