<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                'name_ar' => 'متر',
                'name_en' => 'Meter',
                'department_id' => 1,
                'is_public' => 'yes',
            ],
            [
                'name_ar' => 'سنتيمتر',
                'name_en' => 'Centimter',
                'department_id' => 2,
                'is_public' => 'yes',
            ],
            [
                'name_ar' => 'بوصة',
                'name_en' => 'Inch',
                'department_id' => 3,
                'is_public' => 'yes',
            ],
            [
                'name_ar' => 'سنتيمتر',
                'name_en' => 'Centimter',
                'department_id' => 3,
                'is_public' => 'yes',
            ],

        ];
        foreach ($sizes as $m) {
            Size::create([
                'name_ar' => $m['name_ar'],
                'name_en' => $m['name_en'],
                'department_id' => $m['department_id'],
                'is_public' => $m['is_public'],
            ]);
        }
    }
}
