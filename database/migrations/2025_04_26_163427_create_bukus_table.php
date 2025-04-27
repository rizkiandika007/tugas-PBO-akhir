<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Metadata\Version\ConstraintRequirement;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_bukus');
            $table->string('judul', 255); // Batasin panjang judul
            $table->string('penulis', 255); // Batasin panjang penulis
            $table->string('penerbit', 255); // Batasin panjang penerbit
            $table->date('tahun_terbit')->nullable(); // Pakai year lebih tepat untuk tahun, nullable buat fleksibel
            $table->softDeletes(); // Biar support hapus data tanpa beneran delete
            $table->timestamps(); // Untuk created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
