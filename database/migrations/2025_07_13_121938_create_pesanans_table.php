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
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id();
        $table->string('kode'); // Contoh: OR0001
        $table->string('nama');
        $table->string('no_invoice'); // misal: 000001
        $table->string('telepon');
        $table->string('device');
        $table->date('tanggal');
        $table->string('status'); // Dalam Proses / Selesai
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
