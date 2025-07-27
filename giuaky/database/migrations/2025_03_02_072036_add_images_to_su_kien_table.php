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
            $table->string('logo')->nullable();  // Cột lưu logo sự kiện
            $table->string('background_image')->nullable();  // Cột lưu ảnh nền sự kiện
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('su_kien', function (Blueprint $table) {
        if (Schema::hasColumn('su_kien', 'logo')) {
            $table->dropColumn('logo');
        }
        if (Schema::hasColumn('su_kien', 'background_image')) {
            $table->dropColumn('background_image');
        }
    });
}

};
