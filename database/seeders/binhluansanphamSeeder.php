<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class binhluansanphamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\BinhluanModel::create([
            
            
            'noi_dung' => 'Test noi dung',
            'ma_khach_hang' => '3',
            'ma_san_pham'=> '1',
            'rating' => '1',
            'hien_thi' => '1',
            'created_at' => '1/10/2023',
        ],
      
    );
    }
}
