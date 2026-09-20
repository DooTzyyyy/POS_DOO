<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('login'); // Sesuai dengan view login kamu
    }

    public function auth(Request $request)
    {
        // 1. Validasi input sederhana
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Buat kunci unik berdasarkan email dan IP pengguna
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // 2. Cek apakah sudah salah 3 kali
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $detik = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'login_error' => "Terlalu banyak percobaan salah. Silakan coba lagi dalam {$detik} detik."
            ])->withInput();
        }

        // 3. Proses Login
        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($throttleKey); // Reset jika berhasil
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // 4. Jika salah: tambah 1 hitungan gagal (Jeda 60 detik / 1 menit)
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'login_error' => 'Email atau password salah!'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}