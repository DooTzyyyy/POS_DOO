@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')

<div class="container">

    <h3 class="mb-4 fw-bold">Tambah Jenis</h3>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jenis.store') }}" method="POST">
        @csrf

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="form-label">Nama Jenis</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

@endsection
