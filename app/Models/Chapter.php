<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'chapter_number',
        'chapter_title',
        'content_images'
    ];

    // Otomatis melakukan konversi Array PHP ke format text JSON di database
    protected $casts = [
        'content_images' => 'array',
    ];

    // Relasi Kebalikan: Setiap chapter hanya dimiliki oleh satu komik
    public function comic()
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }
}