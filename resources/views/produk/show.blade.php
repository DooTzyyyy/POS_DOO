@extends('layouts.app')

@section('title','Detail Produk')

@section('content')

<div class="container py-4">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-box-seam-fill"></i>
                Detail Produk
            </h3>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- FOTO -->
                <div class="col-lg-4">

                    @if($produk->foto)

                        <img src="{{ asset('storage/'.$produk->foto) }}"
                             class="img-fluid rounded shadow"
                             style="height:350px;width:100%;object-fit:cover;">

                    @else

                        <div class="border rounded shadow-sm bg-light d-flex justify-content-center align-items-center"
                             style="height:350px;">

                            <div class="text-center text-muted">

                                <i class="bi bi-image fs-1"></i>

                                <p class="mt-2">
                                    Foto Belum Ada
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

                <!-- DETAIL -->
                <div class="col-lg-8">

                    <h2 class="fw-bold text-primary">
                        {{ $produk->nama }}
                    </h2>

                    <hr>

                    <table class="table table-borderless">

                        <tr>
                            <th width="180">Jenis</th>
                            <td>{{ $produk->jenis->nama ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th width="180">User</th>
                            <td>{{ $produk->user->name ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Harga Beli</th>
                            <td class="text-success fw-bold">
                                Rp {{ number_format($produk->harga_beli,0,',','.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Harga Jual</th>
                            <td class="text-primary fw-bold">
                                Rp {{ number_format($produk->harga_jual,0,',','.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Stok</th>
                            <td>

                                @if($produk->stok > 20)

                                    <span class="badge bg-success">
                                        {{ $produk->stok }}
                                    </span>

                                @elseif($produk->stok > 5)

                                    <span class="badge bg-warning text-dark">
                                        {{ $produk->stok }}
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        {{ $produk->stok }}
                                    </span>

                                @endif

                            </td>
                        </tr>

                    </table>

                    <div class="mt-4">

                        <a href="{{ route('produk.index') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Kembali

                        </a>

                        <a href="{{ route('produk.edit',$produk->id) }}"
                           class="btn btn-warning">

                            <i class="bi bi-pencil"></i>
                            Edit

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection