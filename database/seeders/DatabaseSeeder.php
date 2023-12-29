<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanphamModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // SanphamModel::all()::factory(10)->create();

        // \App\Models\SanphamModel::factory(10)->create([
        //     'ten_san_pham' => 'Test User',
        //     'ten_san_pham_slug' => 'Test-User',
        //     'giam_gia_san_pham' => '12',
        //     'giam_giama_loai_san_pham' => '12',
        //     'so_luong' => '12',
        //     'luot_xem' => '12',
        //     'dat_biet' => '0',
        //     'mo_ta' => 'test@example.com',
        //     'trang_thai' => '1',
        // ]);
    }
}