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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_struk', 5)->primary(); // VARCHAR(5) PK, tanpa auto increment
            $table->string('id_pesanan', 5);
            $table->string('id_pelanggan', 5);
            $table->string('total_biaya', 7);
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesananperbaikan')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
