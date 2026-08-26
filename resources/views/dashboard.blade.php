@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background: #f8faff !important;
        color: #172033;
    }

    .dashboard-wrapper {
        padding: 10px 20px 40px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .dashboard-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .dashboard-dot {
        width: 18px;
        height: 18px;
        background: #1677ff;
        border-radius: 50%;
        display: block;
    }

    .dashboard-title h1 {
        font-size: 28px;
        margin: 0;
        font-weight: 700;
        color: #172033;
    }

    .dashboard-title p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #8993a4;
    }

    .welcome-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        border: 1px solid #e9edf5;
        border-radius: 14px;
        padding: 10px 18px;
        box-shadow: 0 2px 8px rgba(30, 60, 100, .03);
    }

    .welcome-icon {
        width: 38px;
        height: 38px;
        background: #eaf3ff;
        border-radius: 50%;
    }

    .welcome-text {
        font-size: 11px;
        color: #9aa3b2;
        line-height: 1.4;
    }

    .welcome-name {
        font-size: 13px;
        font-weight: 700;
        color: #172033;
    }

    .date-text {
        margin-top: 18px;
        margin-left: 32px;
        color: #8993a4;
        font-size: 12px;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #eaf3ff;
        border-radius: 10px;
        padding: 18px;
        min-height: 125px;
        position: relative;
    }

    .stat-card.main {
        background: #1677ff;
        color: white;
    }

    .stat-label {
        font-size: 9px;
        font-weight: 700;
        color: #1677ff;
        text-transform: uppercase;
    }

    .stat-card.main .stat-label {
        color: white;
    }

    .stat-circle {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 8px;
        height: 8px;
        background: #1677ff;
        border-radius: 50%;
    }

    .stat-card.main .stat-circle {
        background: rgba(255,255,255,.4);
    }

    .stat-value {
        margin-top: 12px;
        font-size: 22px;
        font-weight: 700;
        color: #111827;
    }

    .stat-card.main .stat-value {
        color: white;
    }

    .stat-value small {
        font-size: 14px;
        font-weight: 700;
    }

    .stat-description {
        margin-top: 16px;
        font-size: 9px;
        color: #8a94a5;
    }

    .stat-card.main .stat-description {
        color: rgba(255,255,255,.75);
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .dashboard-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #edf0f5;
        padding: 18px;
        box-shadow: 0 2px 10px rgba(30, 60, 100, .025);
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .card-title-area {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-icon {
        width: 16px;
        height: 16px;
        background: #e7f1ff;
        border-radius: 4px;
    }

    .card-icon.blue {
        background: #1677ff;
    }

    .card-title {
        font-size: 14px;
        font-weight: 700;
        color: #172033;
        margin: 0;
    }

    .card-subtitle {
        font-size: 9px;
        color: #9aa3b2;
        margin-top: 3px;
    }

    .count-badge {
        background: #eaf3ff;
        color: #1677ff;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
    }

    .count-badge.blue {
        background: #1677ff;
        color: white;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-table th {
        text-align: left;
        font-size: 9px;
        color: #8f99aa;
        font-weight: 600;
        padding: 8px 4px;
        border-bottom: 1px solid #f0f2f6;
    }

    .dashboard-table td {
        font-size: 11px;
        color: #30394a;
        padding: 11px 4px;
        border-bottom: 1px solid #f4f5f8;
    }

    .dashboard-table th:last-child,
    .dashboard-table td:last-child {
        text-align: right;
    }

    .product-name {
        font-weight: 600;
    }

    .stock-badge {
        display: inline-block;
        background: #eaf3ff;
        color: #1677ff;
        padding: 4px 8px;
        border-radius: 15px;
        font-size: 9px;
        font-weight: 700;
    }

    .empty-badge {
        background: #ffecec;
        color: #e53935;
    }

    .empty-message {
        text-align: center !important;
        color: #9aa3b2 !important;
        padding: 25px !important;
    }

    .best-selling {
        grid-column: 1 / -1;
    }

    .pagination {
        margin-top: 12px;
        font-size: 11px;
    }

    .pagination nav {
        display: flex;
        justify-content: center;
    }

    @media (max-width: 992px) {

        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .best-selling {
            grid-column: auto;
        }

    }

    @media (max-width: 600px) {

        .dashboard-wrapper {
            padding: 10px;
        }

        .dashboard-header {
            display: block;
        }

        .welcome-box {
            margin-top: 18px;
            display: inline-flex;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }

        .stat-card {
            min-height: 110px;
        }

        .dashboard-title h1 {
            font-size: 24px;
        }

        .dashboard-card {
            padding: 14px;
        }

    }
</style>


<div class="dashboard-wrapper">


    {{-- HEADER --}}
    <div class="dashboard-header">

        <div>

            <div class="dashboard-title">

                <span class="dashboard-dot"></span>

                <div>

                    <h1>
                        Dashboard
                    </h1>

                    <p>
                        Ringkasan aktivitas POS hari ini
                    </p>

                </div>

            </div>

            <div class="date-text">

                {{ $tanggalHariIni->translatedFormat('l, d F Y') }}

            </div>

        </div>


        {{-- USER --}}
        <div class="welcome-box">

            <div class="welcome-icon"></div>

            <div>

                <div class="welcome-text">
                    Selamat datang
                </div>

                <div class="welcome-name">
                    {{ Auth::user()->name }}
                </div>

            </div>

        </div>

    </div>



    {{-- STATISTIK ADMIN --}}
    @can('viewAdmin', App\Models\User::class)

    <div class="stat-grid">


        {{-- PENJUALAN --}}
        <div class="stat-card main">

            <span class="stat-circle"></span>

            <div class="stat-label">
                Total Penjualan
            </div>

            <div class="stat-value">

                <small>Rp</small><br>

                {{ number_format($ringkasan['total_penjualan']) }}

            </div>

            <div class="stat-description">
                Total pendapatan hari ini
            </div>

        </div>


        {{-- TRANSAKSI --}}
        <div class="stat-card">

            <span class="stat-circle"></span>

            <div class="stat-label">
                Total Transaksi
            </div>

            <div class="stat-value">

                {{ $ringkasan['total_transaksi'] }}

            </div>

            <div class="stat-description">
                Transaksi berhasil
            </div>

        </div>


        {{-- CASH --}}
        <div class="stat-card">

            <span class="stat-circle"></span>

            <div class="stat-label">
                Pembayaran Tunai
            </div>

            <div class="stat-value">

                Rp {{ number_format($ringkasan['total_cash']) }}

            </div>

            <div class="stat-description">
                Pembayaran cash
            </div>

        </div>


        {{-- NON TUNAI --}}
        <div class="stat-card">

            <span class="stat-circle"></span>

            <div class="stat-label">
                Pembayaran Non Tunai
            </div>

            <div class="stat-value">

                Rp {{ number_format($ringkasan['total_non_tunai']) }}

            </div>

            <div class="stat-description">
                QRIS / Transfer / E-Wallet
            </div>

        </div>

    </div>

    @endcan



    {{-- DATA KASIR --}}
    @can('viewKasir', App\Models\User::class)

    <div class="content-grid">


        {{-- STOK RENDAH --}}
        <div class="dashboard-card">

            <div class="card-header-custom">

                <div class="card-title-area">

                    <div class="card-icon"></div>

                    <div>

                        <div class="card-title">
                            Stok Rendah
                        </div>

                        <div class="card-subtitle">
                            Produk yang perlu diperhatikan
                        </div>

                    </div>

                </div>

                <span class="count-badge">

                    {{ $produkStokRendah->total() }}

                </span>

            </div>


            <table class="dashboard-table">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Stok
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($produkStokRendah as $index => $produk)

                    <tr>

                        <td>
                            {{ $produkStokRendah->firstItem() + $index }}
                        </td>

                        <td class="product-name">
                            {{ $produk->nama }}
                        </td>

                        <td>

                            <span class="stock-badge">

                                {{ $produk->stok }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="empty-message">

                            Semua stok aman

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>


            @if($produkStokRendah->hasPages())

                <div class="pagination">

                    {{ $produkStokRendah->links() }}

                </div>

            @endif

        </div>



        {{-- PRODUK HABIS --}}
        <div class="dashboard-card">

            <div class="card-header-custom">

                <div class="card-title-area">

                    <div class="card-icon blue"></div>

                    <div>

                        <div class="card-title">
                            Produk Habis
                        </div>

                        <div class="card-subtitle">
                            Produk yang perlu direstock
                        </div>

                    </div>

                </div>

                <span class="count-badge blue">

                    {{ $produkStokHabis->total() }}

                </span>

            </div>


            <table class="dashboard-table">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Stok
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($produkStokHabis as $index => $produk)

                    <tr>

                        <td>
                            {{ $produkStokHabis->firstItem() + $index }}
                        </td>

                        <td class="product-name">
                            {{ $produk->nama }}
                        </td>

                        <td>

                            <span class="stock-badge empty-badge">

                                {{ $produk->stok }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="empty-message">

                            Tidak ada produk habis

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>


            @if($produkStokHabis->hasPages())

                <div class="pagination">

                    {{ $produkStokHabis->links() }}

                </div>

            @endif

        </div>



        {{-- PRODUK TERLARIS --}}
        <div class="dashboard-card best-selling">

            <div class="card-header-custom">

                <div class="card-title-area">

                    <div class="card-icon blue"></div>

                    <div>

                        <div class="card-title">
                            Produk Terlaris
                        </div>

                        <div class="card-subtitle">
                            Produk dengan penjualan tertinggi
                        </div>

                    </div>

                </div>

                <span class="count-badge">
                    Top Produk
                </span>

            </div>


            <table class="dashboard-table">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Stok
                        </th>

                        <th>
                            Terjual
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($produkTerlaris as $index => $produk)

                    <tr>

                        <td>

                            <span class="stock-badge">
                                {{ $index + 1 }}
                            </span>

                        </td>

                        <td class="product-name">

                            {{ $produk->nama }}

                        </td>

                        <td>

                            {{ $produk->stok }}

                        </td>

                        <td>

                            <span class="stock-badge">

                                {{ $produk->total_terjual }} unit

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="empty-message">

                            Belum ada data penjualan

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @endcan


</div>

@endsection
