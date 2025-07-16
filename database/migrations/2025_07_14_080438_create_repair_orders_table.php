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
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->string('order_id', 5)->primary(); // manual ID string
            $table->string('customers_id', 5);
            $table->string('technicians_id', 5)->nullable();
            $table->date('order_date');
            $table->string('status', 10);
            $table->string('description', 50)->nullable();
            $table->decimal('estimated_cost', 10, 2);
            $table->date('completion_date');
            $table->timestamps();

            // Foreign keys (disesuaikan dengan nama kolom yang benar)
            $table->foreign('customers_id')->references('customers_id')->on('customers')->onDelete('cascade');
            $table->foreign('technicians_id')->references('technicians_id')->on('technicians')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
