<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    /**
     * Menampilkan halaman baca chapter komik
     */
    public function show($comic_id, $chapter_number)
    {
        // LOGIKA SOFT LOGIN WALL:
        // Jika pengunjung mencoba membaca di atas Chapter 3 DAN belum login (!Auth::check)
        if ($chapter_number > 3 && !Auth::check()) {
            
            // Alihkan pengunjung ke halaman register bawaan Breeze dengan pesan info
            return redirect()->route('register')->with('info', 'Kamu sudah mencapai batas bab gratis. Yuk, buat akun terlebih dahulu untuk melanjutkan membaca chapter berikutnya!');
        }

        // --- Logika jika lolos (Sudah login ATAU masih chapter 1 sampai 3) ---
        // Sementara kita return teks dummy dulu untuk testing:
        return "Kamu sedang membaca Komik ID: " . $comic_id . " pada Chapter: " . $chapter_number;
        
        // Catatan: Nanti kalau tabel chapter sudah siap, kodenya diganti menjadi:
        // $chapter = Chapter::where('comic_id', $comic_id)->where('number', $chapter_number)->firstOrFail();
        // return view('comics.read', compact('chapter'));
    }
}