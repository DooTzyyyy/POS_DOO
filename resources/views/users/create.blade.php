@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<style>
    .form-page {
        padding: 28px 0 40px;
        max-width: 850px;
        margin: auto;
    }

    .form-header {
        margin-bottom: 22px;
    }

    .form-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #172033;
    }

    .form-subtitle {
        margin: 5px 0 0;
        color: #7a8496;
        font-size: 14px;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(20, 32, 55, .04);
        padding: 26px;
    }

    .form-label {
        color: #344054;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        min-height: 42px;
        border-color: #dfe3e9;
        border-radius: 7px;
        font-size: 14px;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
    }

    .form-help {
        color: #98a2b3;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        gap: 9px;
        padding-top: 8px;
        margin-top: 24px;
        border-top: 1px solid #edf0f4;
    }

    .btn-save {
        border: 0;
        border-radius: 7px;
        background: #2563eb;
        color: white;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #1d4ed8;
    }

    .btn-back {
        border: 1px solid #dfe3e9;
        border-radius: 7px;
        background: white;
        color: #475467;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #f8f9fb;
        color: #344054;
    }
</style>

<div class="container form-page">

    <div class="form-header">
        <h1 class="form-title">Tambah User</h1>
        <p class="form-subtitle">
            Tambahkan pengguna baru ke dalam sistem.
        </p>
    </div>

    <div class="form-card">

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password"
                    required>

                <div class="form-help">
                    Gunakan password yang aman dan mudah dikelola.
                </div>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>

                <select
                    name="role_id"
                    class="form-select @error('role_id') is-invalid @enderror"
                    required>

                    <option value="">Pilih role</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach

                </select>

                @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">

                <button type="submit" class="btn-save">
                    Simpan User
                </button>

                <a href="{{ route('admin.users.index') }}" class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
