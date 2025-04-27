<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Perbaikan
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    // Tabel yang dipakai
    protected $table = 'peminjamen';

    // Mass assignment protection
    protected $fillable = ['user_id', 'buku_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'status_peminjaman'];

    /**
     * Relasi dengan model Buku
     * Peminjaman hanya memiliki satu buku
     */
    public function buku(): BelongsTo // Perbaikan di sini
    {
        return $this->belongsTo(Buku::class); // Setiap Peminjaman dimiliki oleh satu Buku
    }

    /**
     * Relasi dengan model User (Peminjam)
     * Setiap Peminjaman dimiliki oleh seorang User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Setiap Peminjaman dimiliki oleh User
    }
}
