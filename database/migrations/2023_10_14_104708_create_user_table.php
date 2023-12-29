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
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tai_khoan');
            $table->string('email');
            $table->string('password');
            $table->string('hinh_anh')->nullable();
            $table->unsignedBigInteger('loai_tai_khoan');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};