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
        Schema::create('hoa_don_chi_tiet', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don',191);
            $table->unsignedBigInteger('ma_san_pham');
            $table->integer('tong_so_luong');
            $table->integer('tong_tien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don_chi_tiet');
    }
};