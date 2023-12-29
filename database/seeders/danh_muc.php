<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DanhmucModel;

class danh_muc extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanhmucModel::create(
            // [
            //     'ten_danh_muc' => 'Nam',
            //     'ten_danh_muc_slug' => 'Nam',
            // ],
            [
                'ten_danh_muc' => 'Nữ',
                'ten_danh_muc_slug' => 'Nữ',
            ],

        );
    }
}
