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
        Schema::table('su_kien', function (Blueprint $table) {
            $table->text('mo_ta_su_kien')->nullable(); // Cột mô tả sự kiện
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('su_kien', function (Blueprint $table) {
            $table->dropColumn('mo_ta_su_kien');
        });
    }
};
