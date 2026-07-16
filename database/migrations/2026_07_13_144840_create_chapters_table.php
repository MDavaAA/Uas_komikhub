<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel comics
            $table->foreignId('comic_id')->constrained('comics')->onDelete('cascade');
            $table->string('title'); // Judul chapter
            $table->string('chapter_number'); // Nomor chapter
            $table->string('file_path')->nullable(); // File atau gambar chapter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};