<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class baiviet extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BaivietModel::create([
                'ten_bai_viet' => 'Test Tiêu Đề',
                'ten_bai_viet_slug' => 'Test Tiêu Đề',
                'mo_ta_ngan' => 'Test Tiêu Đề',
                'ma_khach_hang' => '3',
                'noi_dung' => 'Test Tiêu Đề',
                'hinh_anh' => '111',
                'rating' => '1',
                'hien_thi' => '1',
                'created_at' => '1/10/2023',
            ],
          
        );
    }
}
