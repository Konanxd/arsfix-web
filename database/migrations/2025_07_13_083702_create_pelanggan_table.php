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
    Schema::create('pelanggan', function (Blueprint $table) {
        $table->string('id_pelanggan', 5)->primary();
        $table->string('nama_pelanggan', 50);
        $table->string('no_hp', 12);
        $table->string('handphone', 20);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
