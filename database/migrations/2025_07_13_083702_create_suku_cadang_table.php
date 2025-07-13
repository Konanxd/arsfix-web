<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('suku_cadang', function (Blueprint $table) {
        $table->string('id_part', 5)->primary();
        $table->string('nama_part', 50);
        $table->string('harga', 7);
        $table->integer('stok')->length(3);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suku_cadang');
    }
};
