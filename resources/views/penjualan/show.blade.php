@extends('layouts.app')

@section('title','Detail Penjualan')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Detail Penjualan</h4>
    </div>


    <div class="card-body">
        <p>
            <strong>Kode Transaksi:</strong> {{ $penjualan->kode }} <br>
            <strong>Tanggal:</strong> {{ $penjualan->created_at->format('d-m-Y') }} <br>
            <strong>Status:</strong>
            <span class="badge bg-success">
                {{ $penjualan->status }}
            </span>
        </p>


        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>Rp {{ number_format($penjualan->total) }}</th>
                </tr>
            </tfoot>
        </table>


        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection
