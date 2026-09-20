<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    
    Route::post('/login', function (Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Key limiter berdasarkan IP saja agar salah email/password terhitung di kuota yang sama
        $throttleKey = 'login-attempt:' . $request->ip();
        $maxAttempts = 3;

        $waktuSekarang = now()->translatedFormat('H:i:s') . ' WIB';

        // 1. Cek apakah batas percobaan habis
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $detik = RateLimiter::availableIn($throttleKey);

            return response()->json([
                'status' => 'failed',
                'message' => "Terlalu banyak percobaan salah. Silakan coba lagi dalam {$detik} detik."
            ], 422);
        }

        // 2. Cari user berdasarkan Email
        $user = User::where('email', $request->email)->first();

        // 3. Jika EMAIL TIDAK ADA
        if (!$user) {
            RateLimiter::hit($throttleKey, 60);
            $sisaPercobaan = RateLimiter::remaining($throttleKey, $maxAttempts);

            if ($sisaPercobaan > 0) {
                $pesan = "Login Gagal! Email tidak terdaftar. (Waktu: {$waktuSekarang}) - Sisa percobaan: {$sisaPercobaan} kali.";
            } else {
                $detik = RateLimiter::availableIn($throttleKey);
                $pesan = "Terlalu banyak percobaan salah. Silakan coba lagi dalam {$detik} detik.";
            }

            return response()->json([
                'status' => 'failed',
                'message' => $pesan
            ], 422);
        }

        // 4. Jika PASSWORD SALAH
        if (!Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);
            $sisaPercobaan = RateLimiter::remaining($throttleKey, $maxAttempts);

            if ($sisaPercobaan > 0) {
                $pesan = "Login Gagal! Password salah. (Waktu: {$waktuSekarang}) - Sisa percobaan: {$sisaPercobaan} kali.";
            } else {
                $detik = RateLimiter::availableIn($throttleKey);
                $pesan = "Terlalu banyak percobaan salah. Silakan coba lagi dalam {$detik} detik.";
            }

            return response()->json([
                'status' => 'failed',
                'message' => $pesan
            ], 422);
        }

        // 5. Jika LOGIN BERHASIL
        RateLimiter::clear($throttleKey);
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Login Berhasil! Silakan klik OKE untuk melanjutkan.',
            'redirect' => route('dashboard')
        ]);
    })->name('auth');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // ==========================================
    // ADMIN SAJA
    // ==========================================
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::resource('users', UserController::class);

        });


    // ==========================================
    // TENTANG APLIKASI
    // ADMIN & KASIR
    // ==========================================
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');


    // ==========================================
    // ADMIN & KASIR
    // ==========================================
    Route::middleware('role:admin,kasir')->group(function () {

        Route::resource('jenis', JenisController::class);

        Route::resource('produk', ProdukController::class);

        Route::resource('penjualan', PenjualanController::class);

        Route::resource('itempenjualan', ItemPenjualanController::class);

    });

});