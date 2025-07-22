<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('repair_order_spareparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_order_id')->constrained('repair_orders')->onDelete('cascade');
            $table->foreignId('spare_part_id')->constrained('spare_parts')->onDelete('cascade');
            $table->unsignedInteger('jumlah')->default(1); // Jumlah sparepart yang digunakan
            $table->timestamps();

            $table->unique(['repair_order_id', 'spare_part_id']); // agar tidak ada duplikat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_order_spareparts');
    }
};

