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
    Schema::create('su_kien', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->enum('the_loai', ['Nhạc cải lương', 'Nhạc trẻ', 'Sân khấu & Nghệ thuật', 'Thể thao'])->default('Nhạc trẻ');
            $table->dateTime('ngay');
            $table->string('dia_diem');
            $table->decimal('gia_ve', 10, 2);
            $table->integer('tong_cho_ngoi');
            $table->enum('trang_thai', ['chưa_duyệt', 'đã_duyệt'])->default('chưa_duyệt');
            $table->text('mo_ta_su_kien')->nullable();
            $table->string('logo')->nullable();
            $table->string('background_image')->nullable();
            $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('su_kien');
    }
};
