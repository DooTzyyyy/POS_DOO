@extends('layouts.app')

@section('title', 'Jenis')

@section('content')

<style>
    .jenis-page {
        padding: 28px 0 40px;
    }

    .jenis-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 24px;
        gap: 20px;
    }

    .jenis-title {
        margin: 0;
        color: #172033;
        font-size: 25px;
        font-weight: 700;
        letter-spacing: -0.4px;
    }

    .jenis-subtitle {
        margin: 5px 0 0;
        color: #7b8494;
        font-size: 14px;
    }

    .btn-tambah {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 15px;
        border: none;
        border-radius: 7px;
        background: #2563eb;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-tambah:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
    }

    .jenis-card {
        background: #fff;
        border: 1px solid #e6e9ee;
        border-radius: 11px;
        box-shadow: 0 3px 12px rgba(16, 24, 40, .04);
        overflow: hidden;
    }

    .jenis-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 20px;
        border-bottom: 1px solid #edf0f3;
    }

    .jenis-total {
        color: #667085;
        font-size: 13px;
    }

    .jenis-total strong {
        color: #1d2939;
        font-weight: 700;
    }

    .search-form {
        display: flex;
        width: 320px;
        gap: 7px;
    }

    .search-input {
        height: 38px;
        border: 1px solid #dfe3e8;
        border-radius: 7px;
        padding: 0 12px;
        font-size: 13px;
        color: #344054;
        box-shadow: none !important;
    }

    .search-input:focus {
        border-color: #2563eb;
    }

    .btn-search {
        height: 38px;
        padding: 0 15px;
        border: 1px solid #d8dde5;
        border-radius: 7px;
        background: #fff;
        color: #344054;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-search:hover {
        background: #f8f9fb;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .jenis-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .jenis-table thead th {
        padding: 13px 20px;
        background: #f8f9fb;
        border-bottom: 1px solid #e8ebef;
        color: #667085;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
    }

    .jenis-table tbody td {
        padding: 14px 20px;
        border-bottom: 1px solid #edf0f3;
        color: #344054;
        font-size: 14px;
        vertical-align: middle;
    }

    .jenis-table tbody tr:last-child td {
        border-bottom: none;
    }

    .jenis-table tbody tr {
        transition: background .15s ease;
    }

    .jenis-table tbody tr:hover {
        background: #fafbfc;
    }

    .nomor {
        width: 60px;
        color: #98a2b3 !important;
    }

    .jenis-name {
        display: flex;
        align-items: center;
        gap: 11px;
        color: #1d2939;
        font-weight: 600;
    }

    .jenis-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #eef4ff;
        color: #2563eb;
        font-size: 13px;
        font-weight: 700;
    }

    .aksi {
        width: 180px;
    }

    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-edit {
        padding: 6px 11px;
        border: none;
        border-radius: 6px;
        background: #fff6df;
        color: #a86600;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .15s;
    }

    .btn-edit:hover {
        background: #ffedbd;
        color: #8d5700;
    }

    .btn-hapus {
        padding: 6px 11px;
        border: none;
        border-radius: 6px;
        background: #fff0f0;
        color: #d92d20;
        font-size: 12px;
        font-weight: 600;
        transition: .15s;
    }

    .btn-hapus:hover {
        background: #ffe0df;
    }

    .empty-state {
        padding: 45px 20px !important;
        text-align: center;
        color: #98a2b3 !important;
    }

    .pagination-area {
        padding: 15px 20px;
        border-top: 1px solid #edf0f3;
    }

    .alert-custom {
        border: none;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 18px;
    }

    .alert-success-custom {
        background: #ecfdf3;
        color: #087443;
    }

    .alert-danger-custom {
        background: #fff0f0;
        color: #b42318;
    }

    @media (max-width: 768px) {

        .jenis-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .jenis-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .search-form {
            width: 100%;
        }

        .jenis-page {
            padding-top: 20px;
        }
    }
</style>


<div class="container jenis-page">

    {{-- HEADER --}}
    <div class="jenis-header">

        <div>
            <h1 class="jenis-title">
                Jenis Produk
            </h1>

            <p class="jenis-subtitle">
                Kelola jenis produk yang tersedia di dalam sistem.
            </p>
        </div>

        <a href="{{ route('jenis.create') }}" class="btn-tambah">
            <span>+</span>
            Tambah Jenis
        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-custom alert-success-custom">
            {{ session('success') }}
        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-custom alert-danger-custom">
            {{ session('error') }}
        </div>

    @endif


    {{-- CARD --}}
    <div class="jenis-card">

        {{-- TOOLBAR --}}
        <div class="jenis-toolbar">

            <div class="jenis-total">
                Total
                <strong>{{ $jenises->total() }}</strong>
                jenis produk
            </div>

            <form
                method="GET"
                action="{{ route('jenis.index') }}"
                class="search-form">

                <input
                    type="text"
                    name="search"
                    class="form-control search-input"
                    placeholder="Cari nama jenis..."
                    value="{{ request('search') }}">

                <button
                    type="submit"
                    class="btn-search">
                    Cari
                </button>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="table-wrapper">

            <table class="jenis-table">

                <thead>
                    <tr>
                        <th class="nomor">#</th>
                        <th>Nama Jenis</th>
                        <th class="aksi">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($jenises as $index => $jenis)

                        <tr>

                            <td class="nomor">
                                {{ $jenises->firstItem() + $index }}
                            </td>

                            <td>

                                <div class="jenis-name">

                                    <div class="jenis-icon">
                                        J
                                    </div>

                                    <span>
                                        {{ $jenis->nama }}
                                    </span>

                                </div>

                            </td>

                            <td>

                                <div class="aksi-wrapper">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('jenis.edit', $jenis->id) }}"
                                        class="btn-edit">
                                        Edit
                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('jenis.destroy', $jenis->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-hapus"
                                            onclick="return confirm('Yakin hapus data ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="empty-state">
                                Belum ada jenis produk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($jenises->hasPages())

            <div class="pagination-area">
                {{ $jenises->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
