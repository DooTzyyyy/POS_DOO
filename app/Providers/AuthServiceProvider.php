<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Produk;
use App\Policies\ProdukPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Produk::class => ProdukPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}