<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->string('image')->nullable()->after('stock'); // Tambahkan setelah kolom 'stock' (opsional)
        });
    }

    public function down(): void {
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
