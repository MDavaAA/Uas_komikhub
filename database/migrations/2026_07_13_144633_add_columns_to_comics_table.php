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
        Schema::table('comics', function (Blueprint $table) {
            // Menambahkan kolom yang mungkin belum ada di tabel comics
            if (!Schema::hasColumn('comics', 'author')) {
                $table->string('author')->nullable();
            }
            if (!Schema::hasColumn('comics', 'status')) {
                $table->string('status')->default('Ongoing');
            }
            if (!Schema::hasColumn('comics', 'genre')) {
                $table->string('genre')->nullable();
            }
            if (!Schema::hasColumn('comics', 'synopsis')) {
                $table->text('synopsis')->nullable();
            }
            if (!Schema::hasColumn('comics', 'cover')) {
                $table->string('cover')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comics', function (Blueprint $table) {
            $table->dropColumn(['author', 'status', 'genre', 'synopsis', 'cover']);
        });
    }
};