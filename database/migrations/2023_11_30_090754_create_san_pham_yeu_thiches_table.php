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
        Schema::create('san_pham_yeu_thich', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_san_pham');
            $table->unsignedBigInteger('ma_khach_hang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham_yeu_thich');
    }
};
