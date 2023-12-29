<?php

namespace Database\Seeders;

use App\Models\SanphamModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            SanphamModel::create([
                "ten_san_pham" => $this->generateRandomString(10),
                "ten_san_pham_slug" => str_replace(' ', '-', $this->generateRandomString(10)),
                "gia_san_pham" => random_int(1, 100000000),
                "giam_gia_san_pham" => random_int(1, 100),
                "ma_loai" => random_int(1,1),
                "so_luong" => random_int(1, 10),
                "luot_xem" => random_int(1, 1000),
                "dat_biet" => 0,
                "mo_ta" => 'Ko mieu ta',
                "trang_thai" => 1,
            ]);
        }
    }
    private function generateRandomString($length = 10): string
    {
        return Str::random($length);
    }
}
