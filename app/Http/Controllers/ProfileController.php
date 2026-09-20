<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function index()
    {
        // 1. Mengambil data user yang saat ini sedang login
        $user = Auth::user();

        // 2. Mengembalikan view profile.blade.php sambil membawa data user
        return view('profile', compact('user'));
    }
}
