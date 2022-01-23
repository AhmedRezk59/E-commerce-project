<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name_ar' => 'أزرق',
                'name_en' => 'blue',
                'color' => 'blue',
            ],
            [
                'name_ar' => 'أحمر',
                'name_en' => 'red',
                'color' => 'red'
            ],
        ];
        foreach ($colors as $m) {
            Color::create([
                'name_ar' => $m['name_ar'],
                'name_en' => $m['name_en'],
                'color' => $m['color'],
            ]);
        }
    }
}
