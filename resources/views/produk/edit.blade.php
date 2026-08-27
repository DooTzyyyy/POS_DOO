@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h3 class="fw-bold mb-1 text-dark">
                Edit Produk
            </h3>

            <p class="text-secondary mb-0">
                Perbarui informasi produk yang sudah tersimpan
            </p>

        </div>

        <a
            href="{{ route('produk.index') }}"
            class="btn btn-outline-secondary rounded-3 px-4"
        >
            ← Kembali
        </a>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm rounded-3">

            <div class="fw-semibold mb-2">
                Terdapat beberapa kesalahan:
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <form
            action="{{ route('produk.update', $produk->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <div class="card-body p-4 p-lg-5">

                <div class="row g-5">


                    {{-- INFORMASI --}}
                    <div class="col-lg-7">

                        <div class="mb-4">

                            <h5 class="fw-bold text-dark mb-1">
                                Informasi Produk
                            </h5>

                            <p class="text-secondary small mb-0">
                                Perbarui data produk sesuai kebutuhan.
                            </p>

                        </div>


                        {{-- NAMA --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control form-control-lg rounded-3"
                                value="{{ old('nama', $produk->nama) }}"
                                required
                            >

                        </div>


                        {{-- JENIS --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Jenis Produk
                            </label>

                            <select
                                name="jenis_id"
                                class="form-select form-select-lg rounded-3"
                                required
                            >

                                <option value="">
                                    -- Pilih Jenis Produk --
                                </option>

                                @foreach($jenises as $jenis)

                                    <option
                                        value="{{ $jenis->id }}"
                                        {{ old('jenis_id', $produk->jenis_id) == $jenis->id ? 'selected' : '' }}
                                    >
                                        {{ $jenis->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- HARGA --}}
                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Harga Beli
                                </label>

                                <div class="input-group input-group-lg">

                                    <span class="input-group-text bg-light border-end-0">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="harga_beli"
                                        class="form-control border-start-0 rounded-end-3"
                                        value="{{ old('harga_beli', $produk->harga_beli) }}"
                                        min="0"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Harga Jual
                                </label>

                                <div class="input-group input-group-lg">

                                    <span class="input-group-text bg-light border-end-0">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="harga_jual"
                                        class="form-control border-start-0 rounded-end-3"
                                        value="{{ old('harga_jual', $produk->harga_jual) }}"
                                        min="0"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- STOK --}}
                        <div class="mt-4">

                            <label class="form-label fw-semibold">
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stok"
                                class="form-control form-control-lg rounded-3"
                                value="{{ old('stok', $produk->stok) }}"
                                min="0"
                                required
                            >

                            <small class="text-secondary">
                                Perbarui jumlah stok produk.
                            </small>

                        </div>

                    </div>


                    {{-- FOTO --}}
                    <div class="col-lg-5">

                        <div class="mb-4">

                            <h5 class="fw-bold text-dark mb-1">
                                Foto Produk
                            </h5>

                            <p class="text-secondary small mb-0">
                                Ganti foto jika diperlukan.
                            </p>

                        </div>


                        <div
                            class="border rounded-4 bg-light d-flex align-items-center justify-content-center mb-3"
                            style="height:300px;"
                        >

                            @if($produk->foto)

                                <img
                                    id="previewImage"
                                    src="{{ asset('storage/' . $produk->foto) }}"
                                    alt="{{ $produk->nama }}"
                                    class="img-fluid rounded-3"
                                    style="max-height:280px;max-width:90%;object-fit:contain;"
                                >

                                <div
                                    id="previewText"
                                    style="display:none;"
                                ></div>

                            @else

                                <img
                                    id="previewImage"
                                    src=""
                                    alt="Preview"
                                    class="img-fluid rounded-3"
                                    style="max-height:280px;max-width:90%;display:none;object-fit:contain;"
                                >

                                <div
                                    id="previewText"
                                    class="text-center text-secondary"
                                >

                                    <div
                                        class="bg-white border rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm"
                                        style="width:65px;height:65px;"
                                    >
                                        <span style="font-size:26px;">
                                            📷
                                        </span>
                                    </div>

                                    <div class="fw-semibold text-dark">
                                        Belum ada foto
                                    </div>

                                    <small>
                                        Pilih gambar untuk melihat preview
                                    </small>

                                </div>

                            @endif

                        </div>


                        <input
                            type="file"
                            name="foto"
                            id="fotoInput"
                            class="form-control rounded-3"
                            accept="image/jpeg,image/png,image/jpg"
                        >

                        <small class="text-secondary d-block mt-2">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="border-top bg-light px-4 px-lg-5 py-3">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('produk.index') }}"
                        class="btn btn-outline-secondary rounded-3 px-4"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary rounded-3 px-4"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- PREVIEW FOTO --}}
<script>

document.getElementById('fotoInput').addEventListener('change', function(e) {

    const file = e.target.files[0];

    if (!file) {
        return;
    }

    const image = document.getElementById('previewImage');
    const text = document.getElementById('previewText');

    image.src = URL.createObjectURL(file);

    image.style.display = 'block';

    if (text) {
        text.style.display = 'none';
    }

});

</script>

@endsection
