@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    body {
        background: #ffffff !important;
    }

    .login-page {
        min-height: calc(100vh - 0px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-wrapper {
        width: 100%;
        max-width: 360px;
    }

    .login-card {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 34px 34px 36px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    .login-logo {
        text-align: center;
        margin-bottom: 4px;
    }

    .login-logo h1 {
        margin: 0;
        color: #1677ff;
        font-size: 22px;
        font-weight: 700;
    }

    .login-subtitle {
        text-align: center;
        color: #777777;
        font-size: 12px;
        margin-bottom: 22px;
    }

    .login-label {
        display: block;
        color: #333333;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .login-input {
        width: 100%;
        height: 34px;
        border: 1px solid #dddddd;
        border-radius: 6px;
        padding: 0 10px;
        font-size: 12px;
        color: #333333;
        outline: none;
        box-sizing: border-box;
        margin-bottom: 14px;
    }

    .login-input:focus {
        border-color: #1677ff;
        box-shadow: 0 0 0 3px rgba(22, 119, 255, 0.15);
    }

    /* KOTAK PEMBERITAHUAN GAGAL (MERAH + TOMBOL OKE) */
    .alert-failed {
        display: none;
        color: #dc3545;
        font-size: 12px;
        background-color: #fff2f2;
        border: 1px solid #ffcccb;
        border-radius: 8px;
        padding: 14px 12px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 500;
        line-height: 1.4;
    }

    .btn-alert-failed {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 22px;
        background-color: #dc3545;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-alert-failed:hover {
        background-color: #bd2130;
    }

    /* KOTAK PEMBERITAHUAN SUKSES (HIJAU + TOMBOL OKE) */
    .alert-success {
        display: none;
        color: #155724;
        font-size: 12px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 8px;
        padding: 14px 12px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 600;
        line-height: 1.4;
    }

    .btn-alert-success {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 22px;
        background-color: #28a745;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .btn-alert-success:hover {
        background-color: #218838;
    }

    .login-button {
        width: 100%;
        height: 36px;
        border: none;
        border-radius: 6px;
        background: #1677ff;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 3px;
        transition: background 0.2s;
    }

    .login-button:hover {
        background: #0868ed;
    }

    .login-button:disabled {
        background: #a5c7ff;
        cursor: not-allowed;
    }

    .login-footer {
        text-align: center;
        color: #777777;
        font-size: 11px;
        margin-top: 14px;
    }
</style>

<div class="login-page">

    <div class="login-wrapper">

        <div class="login-card">

            {{-- LOGO --}}
            <div class="login-logo">
                <h1>Aldo Store</h1>
            </div>

            <div class="login-subtitle">
                Silakan masuk ke akun Anda
            </div>

            {{-- KOTAK PEMBERITAHUAN SUKSES (HIJAU + TOMBOL OKE) --}}
            <div class="alert-success" id="alertSuccess">
                <div id="textSuccess">Login Berhasil!</div>
                <a href="#" id="btnOkSuccess" class="btn-alert-success">OKE</a>
            </div>

            {{-- KOTAK PEMBERITAHUAN GAGAL (MERAH + TOMBOL OKE) --}}
            <div class="alert-failed" id="alertFailed">
                <div id="textFailed">Login Gagal!</div>
                <button type="button" id="btnOkFailed" class="btn-alert-failed">OKE</button>
            </div>

            {{-- FORM LOGIN --}}
            <form id="loginForm" action="{{ route('auth') }}" method="POST" novalidate>
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="login-label">Email</label>
                    <input
                        type="text"
                        name="email"
                        id="emailInput"
                        class="login-input"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="login-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        class="login-input"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                {{-- BUTTON LOGIN --}}
                <button type="submit" class="login-button" id="btnSubmit">
                    Login
                </button>

            </form>

        </div>

        <div class="login-footer">
            POS Management System
        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const loginForm = document.getElementById('loginForm');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertFailed = document.getElementById('alertFailed');
        const textSuccess = document.getElementById('textSuccess');
        const textFailed = document.getElementById('textFailed');
        const btnOkSuccess = document.getElementById('btnOkSuccess');
        const btnOkFailed = document.getElementById('btnOkFailed');
        const btnSubmit = document.getElementById('btnSubmit');

        // Klik OKE pada kotak MERAH -> Tutup kotak pesan
        btnOkFailed.addEventListener('click', function () {
            alertFailed.style.display = 'none';
        });

        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Sembunyikan alert sebelumnya saat tombol login ditekan
            alertFailed.style.display = 'none';
            alertSuccess.style.display = 'none';

            btnSubmit.disabled = true;
            btnSubmit.innerText = 'Memproses...';

            const formData = new FormData(loginForm);

            fetch(loginForm.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(async (response) => {
                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    // JIKA BERHASIL: Muncul kotak Hijau + Tombol OKE yang mengarah ke Dashboard
                    textSuccess.innerText = data.message || 'Login Berhasil!';
                    btnOkSuccess.href = data.redirect;
                    alertSuccess.style.display = 'block';

                    btnSubmit.disabled = false;
                    btnSubmit.innerText = 'Login';

                } else {
                    // JIKA GAGAL: Muncul kotak Merah + Tombol OKE untuk menutup kotak
                    textFailed.innerText = data.message || 'Login Gagal! Silakan periksa data Anda.';
                    alertFailed.style.display = 'block';

                    btnSubmit.disabled = false;
                    btnSubmit.innerText = 'Login';
                }
            })
            .catch(() => {
                textFailed.innerText = 'Login Gagal! Terjadi kesalahan koneksi server.';
                alertFailed.style.display = 'block';

                btnSubmit.disabled = false;
                btnSubmit.innerText = 'Login';
            });
        });
    });
</script>

@endsection