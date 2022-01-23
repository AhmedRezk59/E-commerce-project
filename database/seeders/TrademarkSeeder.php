<?php

namespace Database\Seeders;

use App\Models\Trademark;
use Illuminate\Database\Seeder;

class TrademarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trademarks = [
            [
                'name' => 'Apple',
                'logo' => 'image.png'
            ],
            [
                'name' => 'Asus',
                'logo' => 'image.png'
            ],
            [
                'name' => 'Intel',
                'logo' => 'image.png'
            ],
        ];
        foreach ($trademarks as $m) {
            Trademark::create([
                'name' => $m['name'],
                'logo' => $m['logo'],
            ]);
        }
    }
}
