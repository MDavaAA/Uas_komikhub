<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KomikHub - Portal Baca Komik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root, [data-theme="dark"] {
            --bg-base: #0f0f13;
            --bg-surface: #16161b;
            --bg-card: #1c1c24;
            --border-subtle: #23232e;
            --accent-red: #e50914;
            --text-main: #ededed;
            --text-muted-custom: #9494a8;
            --sidebar-active-bg: #2e1115;
        }

        [data-theme="light"] {
            --bg-base: #f4f4f7;
            --bg-surface: #ffffff;
            --bg-card: #ffffff;
            --border-subtle: #d1d1db;
            --accent-red: #e50914;
            --text-main: #1f1f2e;
            --text-muted-custom: #68687a;
            --sidebar-active-bg: #fde8e8;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            height: 100vh;
            overflow: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        #sidebar-wrapper {
            width: 280px;
            min-width: 280px;
            background-color: var(--bg-surface);
            border-right: 1px solid var(--border-subtle);
            display: flex;
            flex-direction: column;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-header .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--accent-red);
            letter-spacing: -0.5px;
        }

        .sidebar-nav {
            overflow-y: auto;
            flex-grow: 1;
            padding: 0 1.25rem 1.25rem 1.25rem;
        }

        /* INTERACTIVE PROFILE BOX */
        .profile-box {
            background-color: var(--bg-base);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .profile-box:hover {
            border-color: rgba(229, 9, 20, 0.4);
            background-color: rgba(255, 255, 255, 0.02);
        }

        .profile-dropdown-menu {
            background-color: var(--bg-card) !important;
            border: 1px solid var(--border-subtle) !important;
            border-radius: 10px !important;
            padding: 0.5rem !important;
            width: calc(100% - 2.5rem);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4) !important;
        }

        .profile-dropdown-menu .dropdown-item {
            color: var(--text-main) !important;
            font-size: 13.5px;
            font-weight: 500;
            padding: 0.65rem 0.85rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background-color: rgba(229, 9, 20, 0.1) !important;
            color: var(--accent-red) !important;
        }

        .sidebar-menu-label {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--text-muted-custom);
            letter-spacing: 1.2px;
            padding: 0 0.5rem;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
        }

        .list-group-item-client {
            background-color: transparent;
            color: var(--text-muted-custom);
            border: none;
            padding: 0.85rem 1rem;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 10px;
            margin-bottom: 0.40rem;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .list-group-item-client:hover {
            background-color: rgba(255, 255, 255, 0.03);
            color: var(--text-main);
        }

        .list-group-item-client.active {
            background-color: var(--sidebar-active-bg) !important;
            color: var(--accent-red) !important;
            font-weight: 600;
        }

        /* SIDEBAR FOOTER (LOGOUT) */
        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid var(--border-subtle);
        }

        /* MAIN CONTENT */
        #page-content-wrapper {
            flex-grow: 1;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            background-color: var(--bg-base);
        }

        .navbar-top {
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 65px;
        }

        .main-content-body {
            padding: 2rem;
        }

        /* GRID CARDS STYLING */
        .comic-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, border-color 0.3s ease;
            height: 100%;
        }

        .comic-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-red);
        }

        .comic-cover-container {
            position: relative;
            aspect-ratio: 3 / 4;
            overflow: hidden;
        }

        .comic-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .comic-card:hover .comic-cover-img {
            transform: scale(1.05);
        }

        .comic-rating-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            color: #f59e0b;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .comic-status-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 10px;
            padding: 3px 6px;
        }

        .theme-toggle-btn {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <!-- SIDEBAR -->
        <div id="sidebar-wrapper">
            <div class="sidebar-header">
                <i class="bi bi-book-half text-danger fs-3"></i>
                <span class="logo-text">KomikHub</span>
            </div>
            
            <div class="sidebar-nav">
                <!-- DROPDOWN PROFILE -->
                <div class="dropdown mb-4">
                    <div class="profile-box" id="profileDropdownClient" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-3 text-secondary flex-shrink-0"></i>
                        <div class="overflow-hidden">
                            <div style="font-size: 11px; color: var(--text-muted-custom); line-height: 1.2;">Masuk Sebagai</div>
                            <div class="fw-bold text-truncate mt-1" style="font-size: 14.5px; color: var(--text-main);">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                    <ul class="dropdown-menu profile-dropdown-menu" aria-labelledby="profileDropdownClient">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark-fill text-danger"></i> Bookmark</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history text-warning"></i> Riwayat Pembacaan</a></li>
                    </ul>
                </div>

                <div class="sidebar-menu-label">Menu Navigasi</div>
                
                <a href="{{ route('dashboard') }}" class="list-group-item-client {{ !$filter ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i> Beranda Utama
                </a>
                <a href="{{ route('dashboard', ['filter' => 'pembaruan']) }}" class="list-group-item-client {{ $filter == 'pembaruan' ? 'active' : '' }}">
                    <i class="bi bi-clock"></i> Pembaruan Terbaru
                </a>
                <a href="{{ route('dashboard', ['filter' => 'populer']) }}" class="list-group-item-client {{ $filter == 'populer' ? 'active' : '' }}">
                    <i class="bi bi-fire"></i> Judul Populer
                </a>
                <a href="{{ route('dashboard', ['filter' => 'tamat']) }}" class="list-group-item-client {{ $filter == 'tamat' ? 'active' : '' }}">
                    <i class="bi bi-check-circle"></i> Komik Tamat
                </a>
            </div>

            <!-- TOMBOL LOGOUT (YANG SEBELUMNYA HILANG) -->
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start rounded-2 py-1.5 px-2.5" style="font-size: 11px;">
                        <i class="bi bi-box-arrow-left me-2"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div id="page-content-wrapper">
            <nav class="navbar-top">
                <h4 class="m-0 fw-bold fs-6">Eksplorasi Judul Komik</h4>
                <button class="theme-toggle-btn" id="themeToggleBtn" onclick="toggleTheme()" title="Ubah Mode Tampilan">
                    <i class="bi bi-sun-fill" id="themeIcon"></i>
                    <span id="themeText" style="font-size: 11.5px; font-weight: 600;">Mode Terang</span>
                </button>
            </nav>

            <div class="main-content-body">
                <h5 class="fw-bold mb-4">
                    Koleksi Komik 
                    <span class="text-danger">
                        @if($filter == 'pembaruan') Baru Diupdate 
                        @elseif($filter == 'populer') Terpopuler (Rating) 
                        @elseif($filter == 'tamat') Berstatus Tamat 
                        @else Terbaru 
                        @endif
                    </span>
                </h5>

                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
                    @forelse($comics as $comic)
                    <div class="col">
                        <!-- LINK UNTUK MEMBUKA DETAIL KOMIK (YANG SEBELUMNYA TIDAK BISA DIKLIK) -->
                        <a href="{{ route('comics.show', $comic->id) }}" class="text-decoration-none" style="color: inherit;">
                            <div class="comic-card d-flex flex-column">
                                <div class="comic-cover-container">
                                    @if($comic->cover)
                                        <img src="{{ asset('covers/' . $comic->cover) }}" class="comic-cover-img" alt="Cover">
                                    @else
                                        <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center fw-bold">NO COVER</div>
                                    @endif
                                    <span class="comic-rating-badge">
                                        <i class="bi bi-star-fill me-1"></i>{{ number_format($comic->rating, 2) }}
                                    </span>
                                    <span class="badge {{ $comic->status == 'Ongoing' ? 'bg-primary' : 'bg-success' }} comic-status-badge">
                                        {{ $comic->status }}
                                    </span>
                                </div>
                                <div class="p-2.5 flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="m-0 fw-bold text-truncate" style="font-size: 13.5px;" title="{{ $comic->title }}">{{ $comic->title }}</h6>
                                        <span class="text-muted d-block text-truncate mt-1" style="font-size: 11px;">{{ $comic->author }}</span>
                                    </div>
                                    <div class="mt-2 pt-2 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                                        <span class="text-warning fw-semibold" style="font-size: 11.5px;">{{ $comic->genre }}</span>
                                        <span class="text-secondary fw-bold" style="font-size: 11px;">{{ $comic->chapters->count() }} Ch</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 py-5 text-center">
                        <i class="bi bi-emoji-frown fs-2 text-secondary"></i>
                        <p class="text-muted mt-2" style="font-size: 13px;">Tidak ada komik yang sesuai dengan filter saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const htmlElement = document.documentElement;
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');

        const savedTheme = localStorage.getItem('komikhub_theme') || 'dark';
        setTheme(savedTheme);

        function toggleTheme() {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
            localStorage.setItem('komikhub_theme', newTheme);
        }

        function setTheme(theme) {
            htmlElement.setAttribute('data-theme', theme);
            if (theme === 'light') {
                themeIcon.className = 'bi bi-moon-fill';
                themeText.textContent = 'Mode Gelap';
            } else {
                themeIcon.className = 'bi bi-sun-fill';
                themeText.textContent = 'Mode Terang';
            }
        }
    </script>
</body>
</html>