<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke tabel roles
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relasi ke tabel produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'user_id');
    }

    // Relasi ke tabel penjualan
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'user_id');
    }
}
