@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Detail Penjualan
            </h3>

            <p class="text-muted mb-0">
                Lihat informasi lengkap transaksi
            </p>
        </div>

        <a href="{{ route('penjualan.index') }}"
           class="btn btn-outline-secondary">
            ← Kembali
        </a>

    </div>


    {{-- INFORMASI TRANSAKSI --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="row align-items-center">

                {{-- KODE --}}
                <div class="col-md-4 mb-3 mb-md-0">

                    <small class="text-muted">
                        Kode Transaksi
                    </small>

                    <h5 class="fw-bold mb-0 mt-1">
                        {{ $penjualan->kode }}
                    </h5>

                </div>


                {{-- TANGGAL --}}
                <div class="col-md-4 mb-3 mb-md-0">

                    <small class="text-muted">
                        Tanggal Transaksi
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $penjualan->created_at->format('d M Y') }}
                    </div>

                    <small class="text-muted">
                        {{ $penjualan->created_at->format('H:i') }} WIB
                    </small>

                </div>


                {{-- STATUS --}}
                <div class="col-md-4">

                    <small class="text-muted d-block mb-2">
                        Status Transaksi
                    </small>

                    @if($penjualan->status == 'COMPLETED')

                        <span class="badge bg-success px-3 py-2">
                            ✓ COMPLETED
                        </span>

                    @elseif($penjualan->status == 'OPEN')

                        <span class="badge bg-warning text-dark px-3 py-2">
                            OPEN
                        </span>

                    @else

                        <span class="badge bg-secondary px-3 py-2">
                            {{ $penjualan->status }}
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- KASIR & PEMBAYARAN --}}
    <div class="row g-4 mb-4">

        {{-- KASIR --}}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="bg-light rounded p-3 me-3">
                            <span class="fs-4">
                                👤
                            </span>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Kasir
                            </small>

                            <h6 class="fw-bold mb-0 mt-1">
                                {{ $penjualan->user->name ?? '-' }}
                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- METODE PEMBAYARAN --}}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center">

                        <div class="bg-light rounded p-3 me-3">
                            <span class="fs-4">
                                💳
                            </span>
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Metode Pembayaran
                            </small>

                            @if(strtolower($penjualan->metode_pembayaran) == 'cash')

                                <span class="badge bg-success mt-1 px-3 py-2">
                                    CASH
                                </span>

                            @elseif(strtolower($penjualan->metode_pembayaran) == 'qris')

                                <span class="badge bg-primary mt-1 px-3 py-2">
                                    QRIS
                                </span>

                            @else

                                <span class="badge bg-secondary mt-1 px-3 py-2">
                                    {{ strtoupper($penjualan->metode_pembayaran) }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR PRODUK --}}
    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
        <div class="card-header bg-white border-0 p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Detail Produk
                    </h5>

                    <small class="text-muted">
                        Produk yang terdapat dalam transaksi
                    </small>

                </div>

                <span class="badge bg-primary px-3 py-2">

                    {{ $penjualan->itemPenjualan->count() }}
                    Produk

                </span>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4">
                            #
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Harga
                        </th>

                        <th class="text-center">
                            Qty
                        </th>

                        <th class="text-end px-4">
                            Subtotal
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($penjualan->itemPenjualan as $item)

                    <tr>

                        {{-- NOMOR --}}
                        <td class="px-4 text-muted">
                            {{ $loop->iteration }}
                        </td>


                        {{-- PRODUK --}}
                        <td>

                            <div class="fw-semibold">
                                {{ $item->produk->nama }}
                            </div>

                        </td>


                        {{-- HARGA --}}
                        <td>

                            Rp {{ number_format($item->harga, 0, ',', '.') }}

                        </td>


                        {{-- QTY --}}
                        <td class="text-center">

                            <span class="badge bg-light text-dark border px-3 py-2">

                                {{ $item->qty }}

                            </span>

                        </td>


                        {{-- SUBTOTAL --}}
                        <td class="text-end px-4">

                            <span class="fw-semibold">

                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-5">

                            <div class="text-muted">

                                <div class="fs-1 mb-2">
                                    🛒
                                </div>

                                <h6 class="fw-semibold">
                                    Belum ada produk
                                </h6>

                                <small>
                                    Tidak ada produk pada transaksi ini.
                                </small>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- TOTAL --}}
        <div class="card-body border-top">

            <div class="row justify-content-end">

                <div class="col-md-5 col-lg-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Jumlah Produk
                        </span>

                        <span class="fw-semibold">
                            {{ $penjualan->itemPenjualan->count() }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Total Barang
                        </span>

                        <span class="fw-semibold">
                            {{ $penjualan->itemPenjualan->sum('qty') }}
                        </span>

                    </div>


                    <div class="border-top pt-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold">
                                Total Pembayaran
                            </span>

                            <span class="fs-5 fw-bold text-primary">

                                Rp {{ number_format($penjualan->total, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="card-footer bg-white border-0 p-4">

            <div class="d-flex justify-content-between align-items-center">

                <small class="text-muted">

                    Transaksi dibuat
                    {{ $penjualan->created_at->format('d-m-Y H:i') }}

                </small>


                <a href="{{ route('penjualan.index') }}"
                   class="btn btn-primary">

                    Kembali ke Penjualan

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
