<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class binhluanbaivietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\binh_luan_bai_viets::create([
            
            
            'noi_dung' => 'Test noi dung',
            'ma_khach_hang' => '3',
            'ma_bai_viet'=> '6',
            'rating' => '1',
            'hien_thi' => '1',
            'created_at' => '1/10/2023',
        ],
    );
    }
}
