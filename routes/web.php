<?php

use App\Http\Controllers\ComicController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Setelah login, Laravel melempar ke /dashboard dan dicek rolenya di sini
Route::get('/dashboard', [ComicController::class, 'checkRole'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Jalur CRUD Komik khusus Admin/Auth
Route::resource('comics', ComicController::class)->middleware(['auth']);

// Jalur Upload Chapter
Route::post('/chapters', [ComicController::class, 'storeChapter'])
    ->middleware(['auth'])
    ->name('chapters.store');

// --- KUSTOM ROUTE LOGOUT ---
Route::post('/logout-home', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::post('/logout-admin', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
});

// Rute sementara buat jadi admin
Route::get('/buat-jadi-admin', function () {
    if (auth()->check()) {
        $user = auth()->user();
        $user->role = 'admin'; // Ganti jadi 'is_admin' = 1 jika di database pakai angka
        $user->save();
        return "Mantap! Akun " . $user->name . " sekarang sudah jadi Admin.";
    }
    return "Kamu belum login! Login dulu di web.";
});

// Mengarahkan URL utama login ke checkRole controller
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ComicController::class, 'checkRole'])->name('dashboard');
    
    // CRUD Routing Komik & Bab
    Route::resource('comics', ComicController::class)->except(['index']);
    Route::post('/chapters', [ComicController::class, 'storeChapter'])->name('chapters.store');
});

require __DIR__.'/auth.php';