<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadRouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['id' => 1, 'name' => 'Hà Nội'],
            ['id' => 2, 'name' => 'Hải Phòng'],
            ['id' => 3, 'name' => 'Quảng Ninh'],
            ['id' => 4, 'name' => 'Hà Nam'],
            ['id' => 5, 'name' => 'Nam Định'],
            ['id' => 6, 'name' => 'Thái Bình'],
            ['id' => 7, 'name' => 'Ninh Bình'],
            ['id' => 8, 'name' => 'Vĩnh Phúc'],
            ['id' => 9, 'name' => 'Bắc Ninh'],
            ['id' => 10, 'name' => 'Hà Giang'],
            ['id' => 11, 'name' => 'Cao Bằng'],
            ['id' => 12, 'name' => 'Lào Cai'],
            ['id' => 13, 'name' => 'Bắc Kạn'],
            ['id' => 14, 'name' => 'Lạng Sơn'],
            ['id' => 15, 'name' => 'Tuyên Quang'],
            ['id' => 16, 'name' => 'Yên Bái'],
            ['id' => 17, 'name' => 'Thái Nguyên'],
            ['id' => 18, 'name' => 'Phú Thọ'],
            ['id' => 19, 'name' => 'Bắc Giang'],
            ['id' => 20, 'name' => 'Hòa Bình'],
            ['id' => 21, 'name' => 'Sơn La'],
            ['id' => 22, 'name' => 'Điện Biên'],
            ['id' => 23, 'name' => 'Lai Châu'],
        ];
        DB::table('city_provinces')->insert($regions);
    }
}
