<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id(); // manual ID string
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('technicians')->onDelete('cascade');
            $table->foreignId('sparepart_id')->constrained('spare_parts')->onDelete('cascade');
            $table->date('order_date');
            $table->enum('status',['Dalam Proses', 'Selesai', 'Batal']);
            $table->longText('description');
            $table->integer('estimated_cost');
            $table->timestamps();

            // // Foreign keys
            // $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            // $table->foreign('technicians_id')->references('technicians_id')->on('technicians')->onDelete('set null');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
