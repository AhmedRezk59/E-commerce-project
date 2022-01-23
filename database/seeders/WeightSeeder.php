<?php

namespace Database\Seeders;

use App\Models\Weight;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weights = [
            [
                'name_ar' => 'كيلوجرام',
                'name_en' => 'Kilo Gram'
            ],
            [
                'name_ar' => 'جرام',
                'name_en' => 'Gram'
            ],
        ];
        foreach ($weights as $m) {
            Weight::create([
                'name_ar' => $m['name_ar'],
                'name_en' => $m['name_en'],
            ]);
        }
    }
}
