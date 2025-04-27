<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    //tabel yang dipakai
    protected $table = 'bukus';

    //mis assigment
    protected $fillable = ['judul','kategori_id', 'penulis','penerbit', 'tahun_terbit'];

    protected $dates = ['deleted_at'];

    public function KategoriBukuRelasi(): BelongsTo
    {
        return $this->belongsTo(KategoriBukuRelasi::class);
    }

    public function KoleksiPribadi(): BelongsTo
    {
        return $this->belongsTo(KoleksiPribadi::class);
    }

    public function Peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class);
    }


}
