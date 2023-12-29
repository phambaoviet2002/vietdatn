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
        Schema::create('loai_san_pham', function (Blueprint $table) {
            $table->id();
            $table->string('ten_loai');
            $table->string('ten_loai_slug');
            $table->unsignedBigInteger('ma_danh_muc');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_san_pham');
    }
};