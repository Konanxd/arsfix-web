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
        Schema::create('pesananperbaikan', function (Blueprint $table) {
            $table->string('id_pesanan', 5)->primary();
            $table->string('id_pelanggan', 5);
            $table->string('id_teknisi', 5);
            $table->date('tgl_order');
            $table->string('status', 10);
            $table->string('deskripsi', 50)->nullable();
            $table->string('estimasi_biaya', 7);
            $table->date('tgl_selesai');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_teknisi')->references('id_teknisi')->on('teknisi')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_perbaikan');
    }
};
