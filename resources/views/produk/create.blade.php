@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="container">

    <h3 class="mb-4 fw-bold">Tambah Produk</h3>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- FOTO --}}
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="foto" class="form-control">
        </div>

        {{-- JENIS --}}
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <select name="jenis_id" class="form-control">
                <option value="">-- Pilih Jenis --</option>
                @foreach ($jenises as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control">
        </div>

        {{-- HARGA BELI --}}
        <div class="mb-3">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control">
        </div>

        {{-- HARGA JUAL --}}
        <div class="mb-3">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control">
        </div>

        {{-- STOK --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

@endsection