<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->string('id', 191)->primary();
            $table->unsignedBigInteger('ma_khach_hang');
            $table->string('ho_va_ten');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->integer('tong_tien_tat_ca');
            $table->integer('trang_thai_don')->default(0);
            $table->integer('trang_thai_thanh_toan')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');
    }
};