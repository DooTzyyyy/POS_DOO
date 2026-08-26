<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_id',
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke jenis (kategori) produk
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    // 🔥 TAMBAHKAN INI: Hubungan ke tabel transaksi penjualan
    // Sesuaikan nama class model ItemPenjualan dengan yang ada di aplikasimu (misal: ItemPenjualan atau PenjualanDetail)
    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }

    // AUTO URL FOTO
    public function getFotoUrlAttribute()
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : 'https://via.placeholder.com/150';
    }
}
