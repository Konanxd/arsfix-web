<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            // Tambahkan kolom technician_id lebih dulu
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade');

            // $table->foreignId('sparepart_id')->constrained('spare_parts')->onDelete('cascade');
            $table->date('order_date');
            $table->enum('status',['Dalam Proses', 'Selesai', 'Batal']);
            $table->longText('description')->nullable();
            $table->integer('estimated_cost');
            // $table->unsignedInteger('jumlah')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
