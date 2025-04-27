<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBukuRelasi extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel
    protected $table = 'Kategori_buku_relasis';

    // Kolom yang bisa diisi
    protected $fillable = [
        'kategori_id',
        'buku_id',
    ];

    // Relasi ke model Buku
    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class);
    }

    // Relasi ke model KategoriBuku
    public function kategoriBuku(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class);
    }
}
