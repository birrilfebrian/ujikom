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
        Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')->constrained('anggotas');
        $table->foreignId('buku_id')->constrained('bukus');
        $table->date('tgl_pinjam');
        $table->date('tgl_kembali_deadline');
        $table->date('tgl_kembali_aktual')->nullable();
        $table->enum('status', ['dipinjam', 'kembali', 'terlambat'])->default('dipinjam');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
