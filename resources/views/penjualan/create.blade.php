@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')

<div class="container">

    <h3>Tambah Penjualan</h3>

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        {{-- Pilih Produk --}}
        <div class="mb-3">
            <label class="form-label">Produk</label>

            <select name="produk_id" class="form-control" required>

                <option value="">-- Pilih Produk --</option>

                @foreach($produk as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama }} (Stok: {{ $item->stok }})
                    </option>
                @endforeach

            </select>

        </div>


        {{-- Jumlah --}}
        <div class="mb-3">
            <label class="form-label">Jumlah</label>

            <input type="number"
                   name="jumlah"
                   class="form-control"
                   min="1"
                   required>

        </div>


        {{-- Metode Pembayaran --}}
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>

            <select name="metode_pembayaran" class="form-control" required>

                <option value="">-- Pilih Pembayaran --</option>

                <option value="cash">
                    Cash
                </option>

                <option value="qris">
                    QRIS
                </option>

            </select>

        </div>


        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

    </form>

</div>

@endsection
