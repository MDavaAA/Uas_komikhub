<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComicController extends Controller
{
    // Memeriksa status role pengguna dan membagikan data ke view yang sesuai dengan filter
    public function checkRole(Request $request) // <-- Menambahkan parameter Request
    {
        // 1. Tangkap parameter filter dari URL (contoh: ?filter=populer)
        $filter = $request->query('filter');

        // 2. Buat query dasar mengambil komik beserta chapternya
        $query = Comic::with('chapters');

        // 3. Logika penyaringan (Filtering) berdasarkan menu yang diklik
        if ($filter == 'pembaruan') {
            // Diurutkan berdasarkan kapan komik terakhir di-update
            $query->orderBy('updated_at', 'desc');
            
        } elseif ($filter == 'populer') {
            // Diurutkan berdasarkan rating/vote tertinggi ala Google/Webtoon
            $query->orderBy('rating', 'desc');
            
        } elseif ($filter == 'tamat') {
            // Hanya mengambil komik dengan status Completed
            $query->where('status', 'Completed');
            
        } else {
            // Default (Beranda Utama): Diurutkan dari yang paling baru diinput
            $query->latest();
        }

        // 4. Eksekusi query untuk mendapatkan data komik terfilter
        $comics = $query->get();
        $totalComics = Comic::count(); // Tetap menghitung total keseluruhan komik untuk info card

        // 5. Kirim data beserta variabel $filter ke View masing-masing role
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard', compact('comics', 'totalComics', 'filter'));
        }

        return view('reader.dashboard', compact('comics', 'filter'));
    }

    // Menampilkan halaman detail komik beserta daftar chapter yang diurutkan
    public function show($id)
    {
        $comic = Comic::with(['chapters' => function ($query) {
            $query->orderBy('chapter_number', 'asc');
        }])->findOrFail($id);
        
        return view('detail', compact('comic'));
    }

    // Menyimpan judul komik baru beserta file gambar sampul (cover) ke public/covers
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string',
            'status' => 'required|string',
            'synopsis' => 'required|string',
            'rating' => 'nullable|numeric|between:0,10', // <-- Tambah validasi rating (Skala 0 - 10)
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();

        // Mengeset nilai default jika rating kosong saat diinput
        if (empty($data['rating'])) {
            $data['rating'] = 0.00;
        }

        if ($request->hasFile('cover')) {
            $imageName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $imageName);
            $data['cover'] = $imageName;
        }

        Comic::create($data);

        return redirect()->route('dashboard')->with('success', 'Komik berhasil ditambahkan!');
    }

    // Memperbarui data komik dan mengganti file gambar cover lama jika ada update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string',
            'status' => 'required|string',
            'synopsis' => 'required|string',
            'rating' => 'nullable|numeric|between:0,10', // <-- Tambah validasi rating saat edit
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $comic = Comic::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('cover')) {
            if ($comic->cover && file_exists(public_path('covers/' . $comic->cover))) {
                unlink(public_path('covers/' . $comic->cover));
            }

            $imageName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $imageName);
            $data['cover'] = $imageName;
        }

        $comic->update($data);

        return redirect()->route('dashboard')->with('success', 'Data komik berhasil diperbarui!');
    }

    // Menghapus data komik dari database beserta file cover fisiknya
    public function destroy($id)
    {
        $comic = Comic::findOrFail($id);

        if ($comic->cover && file_exists(public_path('covers/' . $comic->cover))) {
            unlink(public_path('covers/' . $comic->cover));
        }

        $comic->delete();

        return redirect()->route('dashboard')->with('success', 'Komik berhasil dihapus secara permanen!');
    }

    // Menyimpan data chapter baru beserta kumpulan lembar foto isi komik (Multi-upload)
    public function storeChapter(Request $request)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'chapter_number' => 'required|integer',
            'chapter_title' => 'nullable|string|max:255',
            'content_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096'
        ]);

        $uploadedImages = [];

        if ($request->hasFile('content_images')) {
            foreach ($request->file('content_images') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->extension();
                $folderPath = 'chapters/' . $request->comic_id . '/' . $request->chapter_number;
                $file->move(public_path($folderPath), $filename);
                $uploadedImages[] = $folderPath . '/' . $filename;
            }
        }

        Chapter::create([
            'comic_id' => $request->comic_id,
            'chapter_number' => $request->chapter_number,
            'chapter_title' => $request->chapter_title,
            'content_images' => $uploadedImages
        ]);

        return redirect()->route('dashboard')->with('success', 'Chapter komik baru berhasil diterbitkan!');
    }
}