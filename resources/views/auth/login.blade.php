<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KomikHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg-base: #0f0f13;
            --bg-surface: #16161b;
            --border-subtle: #23232e;
            --accent-red: #e50914;
            --text-main: #ededed;
            --text-muted: #9494a8;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 2.8rem;
            color: var(--accent-red);
            filter: drop-shadow(0 2px 8px rgba(229, 9, 20, 0.3));
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--accent-red);
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .form-control {
            background-color: var(--bg-base);
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 14px;
        }

        .form-control:focus {
            background-color: var(--bg-base);
            border-color: var(--accent-red);
            color: var(--text-main);
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
        }

        .form-label {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .btn-danger-custom {
            background-color: var(--accent-red);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-danger-custom:hover {
            opacity: 0.9;
            background-color: var(--accent-red);
            color: white;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- LOGO DI TENGAH (MENGUTIP TEMA KOMIKHUB) -->
        <div class="logo-container">
            <i class="bi bi-shield-fill-check logo-icon"></i>
            <div>
                <span class="logo-text">KomikHub</span>
            </div>
            <p class="text-muted mt-1" style="font-size: 13px;">Portal Manajemen & Membaca Komik Digital</p>
        </div>

        <!-- SESSION STATUS -->
        @if (session('status'))
            <div class="alert alert-success mb-3 py-2 text-center" style="font-size: 13px;">
                {{ session('status') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL INPUT -->
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email anda">
                @error('email')
                    <div class="invalid-feedback" style="font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- PASSWORD INPUT -->
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback" style="font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- REMEMBER ME & FORGOT PASSWORD -->
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="background-color: var(--bg-base); border-color: var(--border-subtle);">
                    <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">Ingat Saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-danger" style="font-size: 13px;">Lupa sandi?</a>
                @endif
            </div>

            <!-- TOMBOL SUBMIT -->
            <button type="submit" class="btn btn-danger-custom w-100">
                Masuk ke Sistem
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>