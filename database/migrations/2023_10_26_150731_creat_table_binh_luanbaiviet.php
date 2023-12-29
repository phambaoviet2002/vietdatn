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
        Schema::create('binh_luan_bai_viet', function (Blueprint $table) {
            $table->id();
           
            $table->string('noi_dung');
            $table->unsignedBigInteger('ma_khach_hang');
            $table->unsignedBigInteger('ma_bai_viet');
            $table->integer('rating')->default(1);
            $table->integer('hien_thi')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binhLuanBaiViet');
    }
};
