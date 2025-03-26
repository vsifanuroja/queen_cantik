<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <style>
       /* Body */
body {
    height: 100vh;
    font-family: 'Poppins', sans-serif;
    color: #2d6a4f;
    display: flex;
}

.nav__cont {
    width: 80px; /* Default width (hanya ikon terlihat) */
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background-color: #1B5E20; /* Hijau fresh */
    transition: width 0.3s ease-in-out;
    box-shadow: 4px 7px 10px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    z-index: 1050;
    padding-top: 20px;
}

.nav__cont:hover {
    width: 220px; /* Diperbesar saat hover */
}

.nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav__items {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Memberikan jarak antar menu */
}

.nav__link {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    color: white;
    font-size: 1rem;
    text-decoration: none;
    white-space: nowrap;
    border-radius: 8px;
    transition: background 0.3s ease-in-out, transform 0.2s;
}

.nav__link:hover {
    background: #40916c;
    transform: scale(1.05);
}

.nav__link i {
    width: 24px;
    margin-right: 10px;
}

/* Sembunyikan teks saat sidebar tertutup */
.nav__cont:hover .nav__link span {
    display: inline;
}

/* Aktifkan teks hanya saat di-hover */
.nav__link span {
    display: none;
}

.nav__cont:hover .nav__link span {
    display: inline-block;
}

/* Style untuk menu yang aktif */
.nav__link.active {
    background: #52b788;
}

/* Konten utama */
.content {
    margin-left: 90px;
    flex-grow: 1;
    padding: 2rem;
transition: margin-left 0.3s ease-in-out;
}

/* Mode Responsif */
@media (max-width: 768px) {
    .nav__cont {
        width: 60px;
    }
    .nav__cont:hover {
        width: 200px;
    }
    .content {
        margin-left: 70px;
    }
}

    </style>
</head>
<body>
    <div class="nav__cont">
        <ul class="nav">
            <li class="nav__items">
                <a href="{{ route('home') }}" wire:navigate class="nav__link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> <span>Beranda</span>
                </a>

                @if (strtolower(Auth::user()->role) == 'admin')
                <a href="{{ route('user') }}" wire:navigate class="nav__link {{ request()->routeIs('user') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>Pengguna</span>
                </a>

                <a href="{{ route('produk') }}" wire:navigate class="nav__link {{ request()->routeIs('produk') ? 'active' : '' }}">
                    <i class="fas fa-shopping-basket"></i> <span>Produk</span>
                </a>
                @endif

                <a href="{{ route('transaksi') }}" wire:navigate class="nav__link {{ request()->routeIs('transaksi') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave"></i> <span>Transaksi</span>
                </a>

                <a href="{{ route('laporan') }}" wire:navigate class="nav__link {{ request()->routeIs('laporan') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> <span>Laporan</span>
                </a>
            </li>
        </ul>
    </div>


    <div class="content">
        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
