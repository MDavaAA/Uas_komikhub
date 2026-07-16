<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KomikHub Admin - Management Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root, [data-theme="dark"] {
            --bg-base: #0f0f13;
            --bg-surface: #16161b;
            --bg-card: #1c1c24;
            --border-subtle: #292935;
            --accent-red: #e50914;
            --accent-gold: #f59e0b;
            --text-main: #ededed;
            --text-muted-custom: #9494a8;
            --input-bg: #21212b;
            --input-color: #ffffff;
            --table-hover: rgba(255, 255, 255, 0.02);
        }

        [data-theme="light"] {
            --bg-base: #f4f4f7;
            --bg-surface: #ffffff;
            --bg-card: #ffffff;
            --border-subtle: #d1d1db;
            --accent-red: #e50914;
            --accent-gold: #d97706;
            --text-main: #1f1f2e;
            --text-muted-custom: #68687a;
            --input-bg: #f9f9fb;
            --input-color: #1f1f2e;
            --table-hover: rgba(0, 0, 0, 0.02);
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

        /* SIDEBAR STYLING */
        #sidebar-wrapper {
            width: 270px;
            min-width: 270px;
            background-color: var(--bg-surface);
            border-right: 1px solid var(--border-subtle);
            display: flex;
            flex-direction: column;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-heading {
            padding: 1.25rem 1rem;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--accent-red);
            letter-spacing: 0.3px;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .sidebar-nav {
            overflow-y: auto;
            flex-grow: 1;
            padding: 1.25rem 1rem;
        }

        /* PROFILE DROPDOWN BOX */
        .profile-box {
            background-color: var(--bg-base);
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
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
            border-radius: 8px !important;
            padding: 0.4rem !important;
            width: calc(100% - 2rem);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4) !important;
        }

        .profile-dropdown-menu .dropdown-item {
            color: var(--text-main) !important;
            font-size: 12.5px;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background-color: rgba(229, 9, 20, 0.1) !important;
            color: var(--accent-red) !important;
        }

        .sidebar-menu-label {
            font-size: 9.5px;
            font-weight: 700;
            color: var(--text-muted-custom);
            letter-spacing: 1.2px;
            padding: 0 0.5rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: var(--text-muted-custom);
            border: none;
            padding: 0.75rem 1rem;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin-bottom: 0.35rem;
            text-decoration: none;
            transition: all 0.25s ease-in-out;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: rgba(229, 9, 20, 0.08);
            color: var(--text-main);
            transform: translateX(5px);
        }

        #sidebar-wrapper .list-group-item.active {
            background-color: rgba(229, 9, 20, 0.15);
            color: var(--accent-red);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--border-subtle);
        }

        /* MAIN CONTENT STYLING */
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

        .card-custom {
            background-color: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
        }

        /* FORM INPUT */
        .form-label {
            color: var(--text-main) !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border-subtle) !important;
            color: var(--input-color) !important;
            font-size: 12.5px;
        }

        /* TABLE */
        .table-custom-wrapper {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom {
            color: var(--text-main);
            margin: 0;
        }

        .table-custom th {
            background-color: var(--bg-card);
            color: var(--text-muted-custom);
            font-size: 11px;
            text-transform: uppercase;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border-subtle);
        }

        .table-custom td {
            padding: 0.85rem 0.75rem;
            border-bottom: 1px solid var(--border-subtle);
            font-size: 12.5px;
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
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="bi bi-shield-lock-fill text-danger me-2"></i>KomikHub Admin
            </div>
            
            <div class="sidebar-nav">
                <div class="dropdown mb-4">
                    <div class="profile-box" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-badge text-danger fs-3 flex-shrink-0"></i>
                        <div class="overflow-hidden w-100">
                            <div class="d-flex align-items-center justify-content-between mb-0">
                                <span style="font-size: 9.5px; color: var(--text-muted-custom); font-weight: 600;">Status:</span>
                                <span class="badge bg-danger text-light px-2 py-1 fw-bold" style="font-size: 8.5px;">ADMIN</span>
                            </div>
                            <div class="fw-bold text-truncate" style="font-size: 12.5px; line-height: 1.2;">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu-label">Navigasi Data</div>
                <a href="{{ route('dashboard') }}" class="list-group-item {{ !$filter ? 'active' : '' }}">
                    <i class="bi bi-journal-album"></i> Kelola Judul Komik
                </a>
                <a href="{{ route('dashboard', ['filter' => 'pembaruan']) }}" class="list-group-item {{ $filter == 'pembaruan' ? 'active' : '' }}">
                    <i class="bi bi-clock"></i> Pembaruan Terbaru
                </a>
                <a href="{{ route('dashboard', ['filter' => 'populer']) }}" class="list-group-item {{ $filter == 'populer' ? 'active' : '' }}">
                    <i class="bi bi-fire"></i> Judul Populer
                </a>
                <a href="{{ route('dashboard', ['filter' => 'tamat']) }}" class="list-group-item {{ $filter == 'tamat' ? 'active' : '' }}">
                    <i class="bi bi-check-circle"></i> Komik Tamat
                </a>
            </div>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start rounded-2 py-1.5 px-2.5" style="font-size: 11px;">
                        <i class="bi bi-box-arrow-left me-2"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar-top">
                <h4 class="m-0 fw-bold fs-6">Dashboard Pengelolaan Konten</h4>
                <button class="theme-toggle-btn" id="themeToggleBtn" onclick="toggleTheme()" title="Ubah Mode Tampilan">
                    <i class="bi bi-sun-fill" id="themeIcon"></i>
                    <span id="themeText" style="font-size: 11.5px; font-weight: 600;">Mode Terang</span>
                </button>
            </nav>

            <div class="main-content-body">
                @if(session('success'))
                    <div class="alert alert-success bg-success text-light border-0 mb-4 py-2 px-3 rounded-2" style="font-size: 12px;">{{ session('success') }}</div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="p-3 card-custom d-flex align-items-center justify-content-between">
                            <div>
                                <div class="small text-uppercase mb-1" style="font-size: 10px; font-weight: 700; color: var(--text-muted-custom);">Total Koleksi Jilid</div>
                                <h3 class="m-0 fw-bold fs-4">{{ $totalComics }} Judul</h3>
                            </div>
                            <div class="p-2.5 rounded-3 bg-danger bg-opacity-10 text-danger fs-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-collection"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-secondary border-opacity-25">
                    <h5 class="m-0 fs-6 fw-bold">Daftar Komik Terdaftar (Filter: {{ ucfirst($filter ?? 'Semua') }})</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-warning fw-semibold py-1.5 px-3 rounded-2" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#chapterModal">
                            <i class="bi bi-plus-circle me-1"></i> Upload Chapter
                        </button>
                        <button class="btn btn-sm btn-danger fw-semibold py-1.5 px-3 rounded-2" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-journal-plus me-1"></i> Tambah Komik
                        </button>
                    </div>
                </div>

                <div class="table-custom-wrapper">
                    <table class="table table-custom align-middle text-center">
                        <thead>
                            <tr>
                                <th>Sampul</th>
                                <th class="text-start">Judul Komik</th>
                                <th class="text-start">Penulis</th>
                                <th class="text-start">Genre</th>
                                <th>Rating (Vote)</th>
                                <th>Status</th>
                                <th>Total Bab</th>
                                <th>Aksi Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comics as $comic)
                            <tr>
                                <td>
                                    @if($comic->cover)
                                        <img src="{{ asset('covers/' . $comic->cover) }}" alt="Cover" style="width: 40px; height: 55px; object-fit: cover;" class="rounded border border-secondary border-opacity-25">
                                    @else
                                        <div class="bg-secondary rounded mx-auto text-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 55px; font-size: 8px; font-weight: bold;">NULL</div>
                                    @endif
                                </td>
                                <td class="text-start fw-bold">{{ $comic->title }}</td>
                                <td class="text-start" style="color: var(--text-muted-custom);">{{ $comic->author }}</td>
                                <td class="text-start"><span class="text-warning small" style="font-size: 11px;">{{ $comic->genre }}</span></td>
                                <td>
                                    <span class="text-warning fw-bold" style="font-size: 12.5px;">
                                        <i class="bi bi-star-fill me-1"></i>{{ number_format($comic->rating, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $comic->status == 'Ongoing' ? 'bg-primary' : 'bg-success' }}" style="font-size: 9px; padding: 4px 8px;">{{ $comic->status }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-25 text-light fw-bold" style="font-size: 10px; padding: 4px 8px;">{{ $comic->chapters->count() }} Ch</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-sm btn-outline-warning py-1 px-2 rounded-2" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $comic->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('comics.destroy', $comic->id) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2 rounded-2" style="font-size: 11px;" onclick="return confirm('Apakah Anda yakin ingin menghapus judul komik ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="py-5" style="color: var(--text-muted-custom); font-size: 12px;">Sistem mendeteksi data tabel masih kosong. Silakan tambahkan data komik baru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($comics as $comic)
    <div class="modal fade" id="editModal{{ $comic->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-secondary border-opacity-25 rounded-3" style="background-color: var(--bg-card); color: var(--text-main);">
                <form action="{{ route('comics.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-secondary border-opacity-25 py-3">
                        <h5 class="modal-title text-warning fw-bold fs-6"><i class="bi bi-pencil-square me-2"></i>Edit Informasi Komik</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="font-size: 12px;">
                        <div class="mb-3">
                            <label class="form-label">Judul Komik</label>
                            <input type="text" name="title" value="{{ $comic->title }}" class="form-control rounded-2" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="author" value="{{ $comic->author }}" class="form-control rounded-2" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Rilis</label>
                                <select name="status" class="form-select rounded-2" required>
                                    <option value="Ongoing" {{ $comic->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="Completed" {{ $comic->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rating Google / Webtoon</label>
                                <input type="number" step="0.01" min="0" max="10" name="rating" value="{{ $comic->rating }}" class="form-control rounded-2" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover Baru (Kosongkan Jika Tetap)</label>
                                <input type="file" name="cover" class="form-control rounded-2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre (Gunakan Tanda Koma)</label>
                            <input type="text" name="genre" value="{{ $comic->genre }}" class="form-control rounded-2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinopsis Deskripsi</label>
                            <textarea name="synopsis" class="form-control rounded-2" rows="3" required>{{ $comic->synopsis }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary border-opacity-25 py-2">
                        <button type="button" class="btn btn-sm btn-secondary rounded-2" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold rounded-2">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-secondary border-opacity-25 rounded-3" style="background-color: var(--bg-card); color: var(--text-main);">
                <form action="{{ route('comics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-secondary border-opacity-25 py-3">
                        <h5 class="modal-title text-danger fw-bold fs-6"><i class="bi bi-database-add text-warning me-2"></i>Form Input Komik Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="font-size: 12px;">
                        <div class="mb-3">
                            <label class="form-label">Judul Lengkap Komik</label>
                            <input type="text" name="title" class="form-control rounded-2" placeholder="Masukkan judul..." required autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Kreator / Author</label>
                                <input type="text" name="author" class="form-control rounded-2" placeholder="Nama penulis..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Rilis</label>
                                <select name="status" class="form-select rounded-2" required>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rating Google / Webtoon (0 - 10)</label>
                                <input type="number" step="0.01" min="0" max="10" name="rating" class="form-control rounded-2" placeholder="Contoh: 9.85" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Gambar Cover</label>
                                <input type="file" name="cover" class="form-control rounded-2">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre (Pisahkan dengan Koma)</label>
                            <input type="text" name="genre" class="form-control rounded-2" placeholder="Contoh: Action, Adventure, Shounen" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinopsis Cerita</label>
                            <textarea name="synopsis" class="form-control rounded-2" rows="3" placeholder="Tulis sinopsis..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary border-opacity-25 py-2">
                        <button type="button" class="btn btn-sm btn-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger text-light fw-bold rounded-2">Simpan ke Database</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chapterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-secondary border-opacity-25 rounded-3" style="background-color: var(--bg-card); color: var(--text-main);">
                <form action="{{ route('chapters.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-secondary border-opacity-25 py-3">
                        <h5 class="modal-title text-warning fw-bold fs-6"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload File Lembar Chapter</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="font-size: 12px;">
                        <div class="mb-3">
                            <label class="form-label">Hubungkan Ke Komik</label>
                            <select name="comic_id" class="form-select rounded-2" required>
                                @foreach($comics as $comic)
                                    <option value="{{ $comic->id }}">{{ $comic->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nomor Bab</label>
                                <input type="number" name="chapter_number" class="form-control rounded-2" placeholder="1" required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Judul Sub Bab (Opsional)</label>
                                <input type="text" name="chapter_title" class="form-control rounded-2" placeholder="Sub-bab judul...">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih File Lembar Isi Komik</label>
                            <input type="file" name="content_images[]" class="form-control rounded-2" multiple required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary border-opacity-25 py-2">
                        <button type="button" class="btn btn-sm btn-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold rounded-2">Terbitkan Bab</button>
                    </div>
                </form>
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