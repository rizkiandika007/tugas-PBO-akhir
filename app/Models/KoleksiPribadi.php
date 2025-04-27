<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KoleksiPribadi extends Model
{
    use HasFactory,SoftDeletes;

    //tabel yang dipakai
    protected $table = 'koleksi_pribadis';

    //mis assigment
    protected $fillable = ['user_id','buku_id'];

    public function Buku(): HasMany
{
    return $this->hasMany(Buku::class);
}

}