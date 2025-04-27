<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBuku extends Model
{
    use HasFactory, SoftDeletes;

    //tabel yang dipakai
    protected $table = 'kategori_bukus';

    //mis assigment
    protected $fillable = ['nama_kategori'];

    
}

