@extends('layouts.app')

@section('content')


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <!-- Card Utama -->
            <div class="card shadow-sm border-0 rounded-lg overflow-hidden">

                <!-- Header -->
                <div class="card-header text-dark py-3"
                     style="background-color: #6e7aa3 !important;">

                    <h4 class="m-0 font-weight-bold">
                        Tentang Aplikasi aldo store
                    </h4>

                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <!-- Deskripsi -->
                    <p class="lead">
                        <strong>aldo store</strong> adalah aplikasi
                        <strong>Point of Sale (POS)</strong> dan Sistem
                        Informasi Kasir yang dirancang untuk mempermudah
                        transaksi penjualan, manajemen stok produk,
                        serta pengelolaan hak akses pengguna
                        <strong>Admin</strong> dan <strong>Kasir</strong>
                        secara terstruktur.
                    </p>


                    <hr class="my-4">


                    <!-- Fitur Sistem -->
                    <h5 class="font-weight-bold mb-3 text-secondary">
                        Fitur Utama Sistem
                    </h5>

                    <div class="row">

                        <!-- Users -->
                        <div class="col-md-6 mb-3">

                            <div class="p-3 border rounded bg-light h-100">

                                <h6 class="font-weight-bold text-dark">
                                    1. Kelola Users
                                </h6>

                                <small class="text-muted">
                                    Manajemen data akun pengguna serta
                                    pembagian peran (role) sebagai
                                    Admin atau Kasir.
                                </small>

                            </div>

                        </div>


                        <!-- Jenis & Produk -->
                        <div class="col-md-6 mb-3">

                            <div class="p-3 border rounded bg-light h-100">

                                <h6 class="font-weight-bold text-dark">
                                    2. Kelola Jenis & Produk
                                </h6>

                                <small class="text-muted">
                                    Pengelompokan kategori jenis barang
                                    serta pengelolaan data produk dan
                                    stok barang toko.
                                </small>

                            </div>

                        </div>


                        <!-- Transaksi -->
                        <div class="col-md-6 mb-3">

                            <div class="p-3 border rounded bg-light h-100">

                                <h6 class="font-weight-bold text-dark">
                                    3. Transaksi Penjualan
                                </h6>

                                <small class="text-muted">
                                    Proses pencatatan transaksi kasir,
                                    checkout, pengelolaan pesanan,
                                    dan transaksi penjualan.
                                </small>

                            </div>

                        </div>


                        <!-- Hak Akses -->
                        <div class="col-md-6 mb-3">

                            <div class="p-3 border rounded bg-light h-100">

                                <h6 class="font-weight-bold text-dark">
                                    4. Hak Akses (Role-Based)
                                </h6>

                                <small class="text-muted">
                                    Pembatasan fitur berdasarkan role
                                    pengguna untuk menjaga keamanan
                                    data antara Admin dan Kasir.
                                </small>

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    <!-- Informasi Aplikasi -->
                    <div class="text-center">

                        <h5 class="font-weight-bold">
                            aldo store
                        </h5>

                        <p class="text-muted mb-1">
                            Aplikasi Kasir & Manajemen Stok
                        </p>

                        <small class="text-muted">
                            aldo store &copy; {{ date('Y') }}
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
