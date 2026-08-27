@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h3 class="fw-bold mb-1 text-dark">
                Detail Produk
            </h3>

            <p class="text-secondary mb-0">
                Informasi lengkap mengenai produk
            </p>

        </div>

        <a
            href="{{ route('produk.index') }}"
            class="btn btn-outline-secondary rounded-3 px-4"
        >
            ← Kembali
        </a>

    </div>


    {{-- CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="card-body p-4 p-lg-5">

            <div class="row g-5 align-items-center">


                {{-- FOTO --}}
                <div class="col-lg-5">

                    <div
                        class="bg-light border rounded-4 d-flex align-items-center justify-content-center"
                        style="height:390px;"
                    >

                        @if($produk->foto)

                            <img
                                src="{{ asset('storage/' . $produk->foto) }}"
                                alt="{{ $produk->nama }}"
                                class="img-fluid rounded-3"
                                style="max-height:350px;max-width:90%;object-fit:contain;"
                            >

                        @else

                            <div class="text-center text-secondary">

                                <div
                                    class="bg-white border rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm"
                                    style="width:75px;height:75px;"
                                >
                                    <span style="font-size:30px;">
                                        📷
                                    </span>
                                </div>

                                <div class="fw-semibold text-dark">
                                    Tidak ada foto
                                </div>

                                <small>
                                    Foto produk belum tersedia
                                </small>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- INFORMASI --}}
                <div class="col-lg-7">

                    <div class="ps-lg-3">


                        {{-- JUDUL --}}
                        <div class="mb-4">

                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3">

                                {{ $produk->jenis->nama ?? 'Tanpa jenis' }}

                            </span>


                            <h1 class="fw-bold text-dark mb-2">
                                {{ $produk->nama }}
                            </h1>


                            <p class="text-secondary mb-0">

                                Dikelola oleh

                                <span class="fw-semibold text-dark">
                                    {{ $produk->user->name ?? '-' }}
                                </span>

                            </p>

                        </div>


                        {{-- INFORMASI --}}
                        <div class="border-top">


                            {{-- JENIS --}}
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                <span class="text-secondary">
                                    Jenis
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ $produk->jenis->nama ?? '-' }}
                                </span>

                            </div>


                            {{-- USER --}}
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                <span class="text-secondary">
                                    User
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ $produk->user->name ?? '-' }}
                                </span>

                            </div>


                            {{-- HARGA BELI --}}
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                <span class="text-secondary">
                                    Harga Beli
                                </span>

                                <span class="fw-semibold text-dark">
                                    Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                </span>

                            </div>


                            {{-- HARGA JUAL --}}
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                <span class="text-secondary">
                                    Harga Jual
                                </span>

                                <span class="fw-bold text-primary fs-5">
                                    Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                </span>

                            </div>


                            {{-- STOK --}}
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                                <span class="text-secondary">
                                    Stok Tersedia
                                </span>

                                <span>

                                    @if($produk->stok <= 5)

                                        <span class="badge bg-danger rounded-pill px-3 py-2">
                                            {{ $produk->stok }} stok
                                        </span>

                                    @elseif($produk->stok <= 20)

                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                            {{ $produk->stok }} stok
                                        </span>

                                    @else

                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $produk->stok }} stok
                                        </span>

                                    @endif

                                </span>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="mt-4 pt-2 d-flex flex-wrap gap-2">

                            <a
                                href="{{ route('produk.edit', $produk->id) }}"
                                class="btn btn-primary rounded-3 px-4"
                            >
                                Edit Produk
                            </a>

                            <a
                                href="{{ route('produk.index') }}"
                                class="btn btn-outline-secondary rounded-3 px-4"
                            >
                                Kembali
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
