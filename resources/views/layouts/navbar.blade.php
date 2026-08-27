<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    <div class="container py-2">

        <!-- LOGO & MENU -->
        <div class="d-flex align-items-center">

            <!-- LOGO -->
            <a href="{{ route('dashboard') }}"
               class="navbar-brand fw-bold text-primary me-4">
                POS
            </a>

            <!-- MENU -->
            <div class="d-flex align-items-center gap-1">

                <a href="{{ route('dashboard') }}"
                   class="nav-item-custom">
                    Dashboard
                </a>

                @auth
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-item-custom">
                            Users
                        </a>
                    @endif
                @endauth

                <a href="{{ route('jenis.index') }}"
                   class="nav-item-custom">
                    Jenis
                </a>

                <a href="{{ route('produk.index') }}"
                   class="nav-item-custom">
                    Produk
                </a>

                <a href="{{ route('penjualan.index') }}"
                   class="nav-item-custom">
                    Penjualan
                </a>

            </div>
        </div>

        <!-- LOGOUT -->
        @auth
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf

                <button type="submit"
                        class="btn btn-outline-danger btn-sm px-3">
                    Logout
                </button>
            </form>
        @endauth

    </div>
</nav>

<style>
    .nav-item-custom {
        color: #495057;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 7px;
        transition: all 0.2s ease;
    }

    .nav-item-custom:hover {
        color: #0d6efd;
        background-color: #f0f6ff;
    }

    .navbar-brand {
        font-size: 20px;
        letter-spacing: 0.5px;
    }

    .btn-outline-danger {
        border-radius: 7px;
    }
</style>
