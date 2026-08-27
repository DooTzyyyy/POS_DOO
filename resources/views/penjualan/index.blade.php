@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Penjualan
            </h3>

            <p class="text-muted mb-0">
                Kelola transaksi penjualan dan pembayaran
            </p>
        </div>

        <a href="{{ route('penjualan.create') }}"
           class="btn btn-primary">
            Tambah Penjualan
        </a>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('errors'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('errors') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- CARD UTAMA --}}
    <div class="card border-0 shadow-sm">

        {{-- HEADER CARD --}}
        <div class="card-body p-4 border-bottom">

            <div class="row align-items-center">

                <div class="col-md-5">

                    <h5 class="fw-semibold mb-1">
                        Daftar Penjualan
                    </h5>

                    <small class="text-muted">
                        Riwayat transaksi penjualan
                    </small>

                </div>


                <div class="col-md-7">

                    <form action="{{ route('penjualan.index') }}"
                          method="GET"
                          class="mt-3 mt-md-0">

                        <div class="input-group">

                            <input
                                type="text"
                                name="cari"
                                value="{{ request('cari') }}"
                                class="form-control"
                                placeholder="Cari transaksi..."
                            >

                            <button class="btn btn-outline-primary"
                                    type="submit">
                                Search
                            </button>

                        </div>

                    </form>

                </div>

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
                            Tanggal Transaksi
                        </th>

                        <th>
                            Kasir
                        </th>

                        <th>
                            Total Pembayaran
                        </th>

                        <th>
                            Metode Pembayaran
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($sales as $sale)

                    <tr>

                        {{-- NOMOR --}}
                        <td class="px-4 text-muted">
                            {{ $sales->firstItem() + $loop->index }}
                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            <div class="fw-semibold">
                                {{ $sale->created_at->format('d-m-Y') }}
                            </div>

                            <small class="text-muted">
                                {{ $sale->created_at->format('H:i') }}
                            </small>

                        </td>


                        {{-- KASIR --}}
                        <td>

                            <span class="fw-semibold">
                                {{ $sale->user->name ?? '-' }}
                            </span>

                        </td>


                        {{-- TOTAL --}}
                        <td>

                            <span class="fw-semibold">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- METODE PEMBAYARAN --}}
                        <td>

                            <span class="text-uppercase">
                                {{ $sale->metode_pembayaran }}
                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($sale->status == 'COMPLETED')

                                <span class="badge bg-success">
                                    COMPLETED
                                </span>

                            @elseif($sale->status == 'OPEN')

                                <span class="badge bg-warning text-dark">
                                    OPEN
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $sale->status }}
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td>

                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('penjualan.show', $sale) }}"
                                   class="btn btn-primary btn-sm">
                                    Detail
                                </a>


                                @can('view', $sale)

                                    <a href="{{ route('penjualan.edit', $sale) }}"
                                       class="btn btn-outline-secondary btn-sm">
                                        Edit
                                    </a>

                                @endcan


                                @can('delete', $sale)

                                    @if(auth()->user()->role_id == 1)

                                        <form
                                            action="{{ route('penjualan.destroy', $sale) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin akan menghapus transaksi ini?')"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    @endif

                                @endcan

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-5">

                            <div class="text-muted">

                                <h6 class="fw-semibold mb-1">
                                    Belum ada transaksi
                                </h6>

                                <small>
                                    Data penjualan belum tersedia.
                                </small>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($sales->hasPages())

            <div class="card-body border-top">

                {{ $sales->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
