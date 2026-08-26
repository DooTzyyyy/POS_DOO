@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 fw-bold">Edit Produk</h3>

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

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- KIRI -->
            <div class="col-md-6">

                <!-- FOTO SAAT INI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label><br>

                    <img 
                        src="{{ $produk->foto }}" 
                        width="150" 
                        class="img-thumbnail"
                        onerror="this.src='https://via.placeholder.com/150';"
                    >
                </div>

                <!-- INPUT FOTO -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="foto" class="form-control" id="previewInput">
                </div>

                <!-- JENIS -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis</label>
                    <select name="jenis_id" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach ($jenises as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ old('jenis_id', $produk->jenis_id) == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $produk->nama) }}" required>
                </div>

                <!-- HARGA BELI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control"
                        value="{{ old('harga_beli', $produk->harga_beli) }}" required>
                </div>

                <!-- HARGA JUAL -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control"
                        value="{{ old('harga_jual', $produk->harga_jual) }}" required>
                </div>

                <!-- STOK -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stok" class="form-control"
                        value="{{ old('stok', $produk->stok) }}" required>
                </div>

                <button class="btn btn-success px-4">Simpan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <!-- KANAN -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">Preview Foto</label><br>

                <img 
                    id="previewImage" 
                    src="{{ $produk->foto_url }}" 
                    width="200" 
                    class="img-thumbnail"
                    onerror="this.src='https://via.placeholder.com/200';"
                >
            </div>

        </div>
    </form>
</div>

{{-- SCRIPT PREVIEW --}}
<script>
document.getElementById('previewInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('previewImage').src = URL.createObjectURL(file);
    }
});
</script>
@endsection