@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')

<style>
    .form-page {
        max-width: 760px;
        margin: 0 auto;
        padding: 30px 0 40px;
    }

    .form-header {
        margin-bottom: 22px;
    }

    .form-title {
        margin: 0;
        color: #172033;
        font-size: 25px;
        font-weight: 700;
        letter-spacing: -.4px;
    }

    .form-subtitle {
        margin: 5px 0 0;
        color: #7b8494;
        font-size: 14px;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e6e9ee;
        border-radius: 11px;
        padding: 26px;
        box-shadow: 0 3px 12px rgba(16, 24, 40, .04);
    }

    .field-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
    }

    .field-input {
        height: 43px;
        border: 1px solid #dfe3e8;
        border-radius: 7px;
        font-size: 14px;
        color: #344054;
        box-shadow: none !important;
    }

    .field-input:focus {
        border-color: #2563eb;
    }

    .field-help {
        margin-top: 6px;
        color: #98a2b3;
        font-size: 12px;
    }

    .form-footer {
        display: flex;
        gap: 8px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #edf0f3;
    }

    .btn-simpan {
        padding: 9px 17px;
        border: none;
        border-radius: 7px;
        background: #2563eb;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-simpan:hover {
        background: #1d4ed8;
    }

    .btn-kembali {
        padding: 9px 17px;
        border: 1px solid #dfe3e8;
        border-radius: 7px;
        background: #fff;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background: #f8f9fb;
        color: #344054;
    }

    .error-box {
        border: none;
        border-radius: 8px;
        background: #fff0f0;
        color: #b42318;
        font-size: 13px;
        margin-bottom: 20px;
    }
</style>


<div class="container form-page">

    <div class="form-header">

        <h1 class="form-title">
            Tambah Jenis
        </h1>

        <p class="form-subtitle">
            Tambahkan jenis produk baru ke dalam sistem.
        </p>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert error-box">

            <strong>Periksa kembali data yang dimasukkan.</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <div class="form-card">

        <form action="{{ route('jenis.store') }}" method="POST">

            @csrf

            <div>

                <label class="field-label">
                    Nama Jenis
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control field-input"
                    value="{{ old('nama') }}"
                    placeholder="Contoh: Makanan, Minuman, Snack..."
                    required>

                <div class="field-help">
                    Masukkan nama jenis produk yang mudah dikenali.
                </div>

            </div>


            <div class="form-footer">

                <button type="submit" class="btn-simpan">
                    Simpan Jenis
                </button>

                <a
                    href="{{ route('jenis.index') }}"
                    class="btn-kembali">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
