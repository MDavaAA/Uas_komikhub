<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'status',
        'synopsis',
        'rating', // <-- Pastikan rating ada di sini!
        'cover'
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}