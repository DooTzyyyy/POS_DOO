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
        border-radius: 6px;
        padding: 34px 34px 36px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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

    .login-error {
        color: #dc3545;
        font-size: 11px;
        margin-top: -9px;
        margin-bottom: 10px;
    }

    .login-button {
        width: 100%;
        height: 36px;
        border: none;
        border-radius: 5px;
        background: #1677ff;
        color: #ffffff;
        font-size: 12px;
        cursor: pointer;
        margin-top: 3px;
    }

    .login-button:hover {
        background: #0868ed;
    }

    .login-footer {
        text-align: center;
        color: #777777;
        font-size: 11px;
        margin-top: 14px;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 30px 25px;
        }
    }
</style>


<div class="login-page">

    <div class="login-wrapper">

        <div class="login-card">

            {{-- LOGO --}}
            <div class="login-logo">
                <h1>POS</h1>
            </div>

            <div class="login-subtitle">
                Silakan masuk ke akun Anda
            </div>


            {{-- FORM LOGIN --}}
            <form action="{{ route('auth') }}" method="POST">

                @csrf


                {{-- EMAIL --}}
                <div>

                    <label class="login-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="login-input"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >

                    @error('email')
                        <div class="login-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PASSWORD --}}
                <div>

                    <label class="login-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="login-input"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    @error('password')
                        <div class="login-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="login-button">
                    Login
                </button>

            </form>

        </div>


        {{-- FOOTER --}}
        <div class="login-footer">
            POS Management System
        </div>

    </div>

</div>

@endsection
