<nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container py-2 d-flex justify-content-between">

        <!-- KIRI -->
        <div class="d-flex align-items-center gap-3">

            <a class="navbar-brand m-0 fw-bold text-dark" href="{{ route('dashboard') }}">
                POS
            </a>

            <a class="nav-link m-0 text-dark fw-semibold" href="{{ route('dashboard') }}">
                Dashboard
            </a>

            @auth
                @if(auth()->user()->role_id == 1)
                    <a class="nav-link m-0 text-dark fw-semibold" href="{{ route('admin.users.index') }}">
                        Users
                    </a>
                @endif
            @endauth

            <a class="nav-link m-0 text-dark fw-semibold" href="{{ route('jenis.index') }}">
                Jenis
            </a>

            <a class="nav-link m-0 text-dark fw-semibold" href="{{ route('produk.index') }}">
                Produk
            </a>

            <a class="nav-link m-0 text-dark fw-semibold" href="{{ route('penjualan.index') }}">
                Penjualan
            </a>


        </div>

        <!-- KANAN -->
        @auth
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>
        @endauth

    </div>
</nav>
