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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Perbaikan pada cascadeOnDelete
            $table->foreignId('buku_id')->constrained()->cascadeOnDelete(); // Perbaikan pada cascadeOnDelete
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->string('status_peminjaman'); // Perbaiki penulisan status_peminjaman
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
