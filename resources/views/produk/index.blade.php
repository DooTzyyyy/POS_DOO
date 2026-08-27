@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<div class="container-fluid py-4 px-4 px-lg-5">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1 text-dark">
                Produk
            </h3>

            <p class="text-secondary mb-0">
                Kelola data produk dan stok barang
            </p>
        </div>

        <a
            href="{{ route('produk.create') }}"
            class="btn btn-primary rounded-3 px-4 shadow-sm"
        >
            + Tambah Produk
        </a>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4"
            role="alert"
        >

            <strong>Berhasil!</strong>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">


        {{-- CARD HEADER --}}
        <div class="card-body p-4 border-bottom bg-white">

            <div class="row align-items-center g-3">

                <div class="col-lg-6">

                    <h5 class="fw-bold mb-1 text-dark">
                        Daftar Produk
                    </h5>

                    <small class="text-secondary">
                        Menampilkan
                        <span class="fw-semibold text-dark">
                            {{ $produks->total() }}
                        </span>
                        produk
                    </small>

                </div>


                <div class="col-lg-6">

                    <form
                        method="GET"
                        action="{{ route('produk.index') }}"
                        class="d-flex justify-content-lg-end gap-2"
                    >

                        <input
                            type="text"
                            name="search"
                            class="form-control rounded-3"
                            style="max-width: 280px;"
                            placeholder="Cari nama produk..."
                            value="{{ request('search') }}"
                        >

                        <button
                            type="submit"
                            class="btn btn-outline-primary rounded-3 px-4"
                        >
                            Cari
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th
                            class="px-4 py-3 text-secondary small fw-semibold"
                            style="width: 60px;"
                        >
                            #
                        </th>

                        <th class="py-3 text-secondary small fw-semibold">
                            PRODUK
                        </th>

                        <th class="py-3 text-secondary small fw-semibold">
                            JENIS
                        </th>

                        <th class="py-3 text-secondary small fw-semibold">
                            HARGA BELI
                        </th>

                        <th class="py-3 text-secondary small fw-semibold">
                            HARGA JUAL
                        </th>

                        <th class="py-3 text-secondary small fw-semibold">
                            STOK
                        </th>

                        <th
                            class="py-3 text-secondary small fw-semibold text-center"
                            style="width: 230px;"
                        >
                            AKSI
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($produks as $index => $produk)

                    <tr>

                        {{-- NOMOR --}}
                        <td class="px-4 text-secondary">
                            {{ $produks->firstItem() + $index }}
                        </td>


                        {{-- PRODUK --}}
                        <td>

                            <div class="d-flex align-items-center">

                                @if($produk->foto)

                                    <img
                                        src="{{ asset('storage/' . $produk->foto) }}"
                                        alt="{{ $produk->nama }}"
                                        width="52"
                                        height="52"
                                        class="rounded-3 border me-3"
                                        style="object-fit: cover;"
                                    >

                                @else

                                    <div
                                        class="bg-light border rounded-3 me-3 d-flex align-items-center justify-content-center text-secondary"
                                        style="width:52px;height:52px;"
                                    >
                                        <span style="font-size:20px;">
                                            📦
                                        </span>
                                    </div>

                                @endif


                                <div>

                                    <div class="fw-semibold text-dark mb-1">
                                        {{ $produk->nama }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $produk->user->name ?? 'Tanpa pengguna' }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- JENIS --}}
                        <td>

                            @if($produk->jenis)

                                <span class="text-dark">
                                    {{ $produk->jenis->nama }}
                                </span>

                            @else

                                <span class="text-secondary">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- HARGA BELI --}}
                        <td>

                            <span class="text-dark">
                                Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- HARGA JUAL --}}
                        <td>

                            <span class="fw-semibold text-primary">
                                Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- STOK --}}
                        <td>

                            @if($produk->stok <= 5)

                                <span class="badge rounded-pill bg-danger px-3 py-2">
                                    {{ $produk->stok }}
                                </span>

                            @elseif($produk->stok <= 20)

                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                    {{ $produk->stok }}
                                </span>

                            @else

                                <span class="badge rounded-pill bg-success px-3 py-2">
                                    {{ $produk->stok }}
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td>

                            <div class="d-flex justify-content-center gap-1">

                                @can('view', $produk)

                                    <a
                                        href="{{ route('produk.show', $produk->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-3"
                                    >
                                        Detail
                                    </a>

                                @endcan


                                <a
                                    href="{{ route('produk.edit', $produk->id) }}"
                                    class="btn btn-sm btn-outline-secondary rounded-3"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('produk.destroy', $produk->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger rounded-3"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-5"
                        >

                            <div class="py-3">

                                <div
                                    class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width:70px;height:70px;"
                                >
                                    <span style="font-size:28px;">
                                        📦
                                    </span>
                                </div>

                                <h6 class="fw-bold text-dark mb-1">
                                    Belum ada produk
                                </h6>

                                <p class="text-secondary small mb-3">
                                    Silakan tambahkan produk terlebih dahulu.
                                </p>

                                <a
                                    href="{{ route('produk.create') }}"
                                    class="btn btn-primary btn-sm rounded-3 px-3"
                                >
                                    + Tambah Produk
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($produks->hasPages())

            <div class="card-body border-top bg-white">

                {{ $produks->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
