<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comics', function (Blueprint $table) {
            // Kolom rating untuk menyimpan vote dari Google/Webtoon (contoh: 9.85)
            $table->decimal('rating', 3, 2)->default(0.00)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('comics', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
};