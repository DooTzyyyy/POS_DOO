@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<div class="container">

    <h4 class="mb-3 fw-bold">Halaman Produk</h4>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TOP BAR --}}
    <div class="d-flex justify-content-between mb-3">

        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
            Tambah Produk
        </a>

        <form method="GET" action="{{ route('produk.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control form-control-sm me-2"
                placeholder="cari nama produk..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary btn-sm">Search</button>
        </form>

    </div>

    {{-- TABLE --}}
    <table class="table table-bordered table-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Foto</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($produks as $index => $produk)
                <tr>
                    <td>{{ $produks->firstItem() + $index }}</td>
                    <td>{{ $produk->user->name ?? '-' }}</td>

                    {{-- FOTO --}}
                    <td>
                        @if($produk->foto)
                            <img src="{{ asset('storage/'.$produk->foto) }}" width="40">
                        @else
                            <img src="https://via.placeholder.com/40" width="40">
                        @endif
                    </td>

                    <td>{{ $produk->jenis->nama ?? '-' }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ number_format($produk->harga_beli) }}</td>
                    <td>{{ number_format($produk->harga_jual) }}</td>
                    <td>{{ $produk->stok }}</td>

                    {{-- AKSI --}}
                    <td class="d-flex gap-1">

                        {{-- DETAIL --}}
                        @can('view', $produk)
                        <a href="{{ route('produk.show', $produk->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>
                        @endcan

                        {{-- EDIT --}}
                        <a href="{{ route('produk.edit', $produk->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('produk.destroy', $produk->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="9" class="text-center">Data kosong</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    {{-- PAGINATION --}}
    {{ $produks->links() }}

</div>

@endsection