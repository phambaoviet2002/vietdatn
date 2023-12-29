<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaisanphamModel;
class loai_san_pham extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoaisanphamModel::create(
            // [
            //     'ten_loai' => 'gucci',
            //     'ten_loai_slug' => 'gucci',
            //     'ma_danh_muc' => '2',
            // ],
            // [
            //     'ten_loai' => 'luis-vuiton',
            //     'ten_loai_slug' => 'luis-vuiton',
            //     'ma_danh_muc' => '2',
            // ],
            // [
            //     'ten_loai' => 'chanel',
            //     'ten_loai_slug' => 'chanel',
            //     'ma_danh_muc' => '2',
            // ],
            [
                'ten_loai' => 'Suprime',
                'ten_loai_slug' => 'Suprime',
                'ma_danh_muc' => '2',
            ],
            

        );
    }
}
