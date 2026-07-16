<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $comic->title }} - KomikHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-base: #0b0b0e;
            --bg-surface: #131318;
            --bg-card: #1a1a22;
            --border-subtle: #272733;
            --accent-red: #e50914;
        }

        body {
            background-color: var(--bg-base);
            color: #e4e4e7;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar-custom {
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.75rem 1.5rem;
        }

        .detail-hero {
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-subtle);
            padding: 2rem 0;
            position: relative;
        }

        .poster-wrapper {
            width: 170px;
            height: 245px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid var(--border-subtle);
            background-color: #000;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            margin: 0 auto;
        }

        .poster-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.75rem;
            background-color: rgba(0, 0, 0, 0.25);
            border: 1px solid var(--border-subtle);
            border-radius: 6px;
            padding: 0.75rem;
            margin: 1rem 0;
        }

        .meta-item-label {
            font-size: 10px;
            color: #8c8c9e;
            text-transform: uppercase;
        }

        .meta-item-value {
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        .genre-badge {
            background-color: rgba(229, 9, 20, 0.12);
            color: #ff4d55;
            border: 1px solid rgba(229, 9, 20, 0.25);
            font-size: 10.5px;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .content-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            padding: 1.25rem;
            height: 100%;
        }

        .chapter-list-box {
            max-height: 280px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .chapter-list-box::-webkit-scrollbar {
            width: 4px;
        }
        .chapter-list-box::-webkit-scrollbar-thumb {
            background: var(--border-subtle);
            border-radius: 2px;
        }

        .chapter-row {
            background-color: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: #fff;
            font-size: 12px;
            transition: all 0.15s ease;
        }

        .chapter-row:hover {
            background-color: #242430;
            border-color: rgba(229, 9, 20, 0.4);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark navbar-custom">
        <div class="container-fluid">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-light rounded-pill px-3" style="font-size: 11px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <span class="navbar-brand fw-bold fs-6 m-0 text-danger"><i class="bi bi-book-half me-2"></i>KomikHub</span>
        </div>
    </nav>

    <header class="detail-hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-3 text-center">
                    <div class="poster-wrapper">
                        @if($comic->cover)
                            <img src="{{ asset('covers/' . $comic->cover) }}" alt="{{ $comic->title }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center text-secondary h-100 fw-bold" style="font-size: 9px;">NO COVER</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <span class="badge bg-danger text-uppercase px-2 py-0.5 mb-2" style="font-size: 8px; letter-spacing: 0.5px;">{{ $comic->status }}</span>
                    <h1 class="text-white fw-bold mb-2 fs-4">{{ $comic->title }}</h1>
                    
                    <div class="meta-grid">
                        <div>
                            <div class="meta-item-label">Author</div>
                            <div class="meta-item-value text-truncate">{{ $comic->author ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="meta-item-label">Total Bab</div>
                            <div class="meta-item-value">{{ $comic->chapters->count() }} Bab</div>
                        </div>
                        <div>
                            <div class="meta-item-label">Status Rilis</div>
                            <div class="meta-item-value text-capitalize">{{ $comic->status }}</div>
                        </div>
                    </div>

                    <div>
                        @if($comic->genre)
                            @foreach(explode(',', $comic->genre) as $g)
                                <span class="genre-badge">{{ trim($g) }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container my-4">
        <div class="row g-3">
            <div class="col-lg-5">
                <div class="content-card">
                    <h5 class="text-white fw-bold mb-2" style="font-size: 13.5px;"><i class="bi bi-info-circle text-danger me-2"></i>Sinopsis</h5>
                    <p class="text-secondary m-0" style="font-size: 12px; line-height: 1.5;">
                        {{ $comic->synopsis ?? 'Belum ada ringkasan sinopsis untuk komik ini.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="content-card">
                    <h5 class="text-white fw-bold mb-2.5" style="font-size: 13.5px;">
                        <i class="bi bi-list-task text-danger me-2"></i>Daftar Bab (Chapter)
                    </h5>
                    <div class="chapter-list-box">
                        @forelse($comic->chapters as $chapter)
                            <a href="#" class="chapter-row">
                                <span class="fw-semibold">{{ $chapter->chapter_title ?? 'Bab ' . $chapter->chapter_number }}</span>
                                <span class="text-muted" style="font-size: 10px;">{{ $chapter->created_at ? $chapter->created_at->diffForHumans() : 'Baru' }}</span>
                            </a>
                        @empty
                            <div class="text-center text-muted py-4" style="font-size: 11px;">Belum ada bab yang dirilis untuk judul ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>