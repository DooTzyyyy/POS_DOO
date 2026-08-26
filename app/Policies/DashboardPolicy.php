<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    // Khusus ADMIN
    public function viewAdmin(User $user)
    {
        return $user->role_id == 1;
    }

    // Admin + Kasir
    public function viewKasir(User $user)
    {
        return in_array($user->role_id, [1, 2]);
    }
}