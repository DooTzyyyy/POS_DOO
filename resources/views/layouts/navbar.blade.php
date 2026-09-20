<nav class="navbar navbar-expand-lg navbar-dark navbar-black">
    <div class="container py-2">

        <!-- LOGO & MENU -->
        <div class="d-flex align-items-center">

           <!-- LOGO -->
            <a href="{{ route('dashboard') }}"
            class="navbar-brand fw-bold text-white bg-secondary rounded px-3 py-2 me-4">
                AS
            </a>


            <!-- MENU -->
            <div class="d-flex align-items-center gap-1">

                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}"
                   class="nav-item-custom">
                    Dashboard
                </a>

                <!-- USERS - ADMIN SAJA -->
                @auth
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-item-custom">
                            Users
                        </a>
                    @endif
                @endauth

                <!-- JENIS -->
                <a href="{{ route('jenis.index') }}"
                   class="nav-item-custom">
                    Jenis
                </a>

                <!-- PRODUK -->
                <a href="{{ route('produk.index') }}"
                   class="nav-item-custom">
                    Produk
                </a>

                <!-- PENJUALAN -->
                <a href="{{ route('penjualan.index') }}"
                   class="nav-item-custom">
                    Penjualan
                </a>

                <!-- TENTANG -->
                <a href="{{ route('tentang') }}"
                   class="nav-item-custom">
                    Tentang
                </a>

            </div>
        </div>


        <!-- LOGOUT -->
        @auth
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf

                <button type="submit"
                        class="btn btn-logout">
                    Keluar
                </button>
            </form>
        @endauth

    </div>
</nav>


<style>

    /* ==============================
       NAVBAR HITAM
    ============================== */

    .navbar-black {
        background: #111111 !important;

        border-bottom: 1px solid #2b2b2b;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.20);

        padding-top: 4px;
        padding-bottom: 4px;
    }


    /* ==============================
       LOGO
    ============================== */

    .navbar-brand-custom {
        color: #ffffff;

        text-decoration: none;

        font-size: 23px;
        font-weight: 800;

        letter-spacing: 1px;

        padding: 8px 15px;
        margin-right: 18px;

        border-radius: 8px;

        background: #222222;

        transition: all 0.25s ease;
    }

    .navbar-brand-custom:hover {
        color: #ffffff;

        text-decoration: none;

        background: #333333;

        transform: translateY(-1px);
    }


    /* ==============================
       MENU
    ============================== */

    .nav-item-custom {
        color: #dddddd;

        text-decoration: none;

        font-size: 14px;
        font-weight: 500;

        padding: 9px 13px;

        border-radius: 7px;

        transition: all 0.25s ease;
    }


    .nav-item-custom:hover {
        color: #ffffff;

        text-decoration: none;

        background: #2b2b2b;

        transform: translateY(-1px);
    }


    /* ==============================
       LOGOUT
    ============================== */

    .btn-logout {
        color: #ffffff;

        background: #dc3545;

        border: 1px solid #dc3545;

        border-radius: 7px;

        padding: 7px 17px;

        font-size: 14px;
        font-weight: 500;

        transition: all 0.25s ease;
    }


    .btn-logout:hover {
        color: #ffffff;

        background: #bb2d3b;

        border-color: #bb2d3b;

        transform: translateY(-1px);

        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 768px) {

        .navbar-black .container {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar-brand-custom {
            margin-bottom: 10px;
        }

        .nav-item-custom {
            font-size: 13px;
            padding: 7px 9px;
        }

        .btn-logout {
            margin-top: 10px;
        }
    }

</style>
