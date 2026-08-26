<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produk;

class ProdukPolicy
{
    public function view(User $user, Produk $produk)
    {
        return true;
    }

    public function update(User $user, Produk $produk)
    {
        return true;
    }

    public function delete(User $user, Produk $produk)
    {
        return true;
    }
}