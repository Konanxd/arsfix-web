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
    Schema::create('teknisi', function (Blueprint $table) {
        $table->string('id_teknisi', 5)->primary();
        $table->string('nama_teknisi', 50);
        $table->string('data_login', 7)->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teknisi');
    }
};
