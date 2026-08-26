@extends('layouts.app')

@section('title', 'Jenis')

@section('content')

<div class="container">

    <h4 class="mb-3 fw-bold">Halaman Jenis Produk</h4>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- TOP BAR --}}
    <div class="d-flex justify-content-between mb-3">

        <a href="{{ route('jenis.create') }}" class="btn btn-primary btn-sm">
            Tambah Jenis
        </a>

        <form method="GET" action="{{ route('jenis.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control form-control-sm me-2"
                placeholder="cari nama jenis..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary btn-sm">Search</button>
        </form>

    </div>

    {{-- TABLE --}}
    <table class="table table-bordered table-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Jenis</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($jenises as $index => $jenis)
                <tr>
                    <td>{{ $jenises->firstItem() + $index }}</td>
                    <td>{{ $jenis->nama }}</td>

                    {{-- AKSI --}}
                    <td class="d-flex gap-1">

                        {{-- EDIT --}}
                        <a href="{{ route('jenis.edit', $jenis->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('jenis.destroy', $jenis->id) }}"
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
                    <td colspan="3" class="text-center">Data kosong</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    {{-- PAGINATION --}}
    {{ $jenises->links() }}

</div>

@endsection
