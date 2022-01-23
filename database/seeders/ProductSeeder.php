<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Asus Laptop',
                'content' => 'An awesome laptop',
                'photo' => 'IMG-20200817-WA0000.jpg',
                'department_id' => 2,
                'color_id' => 1,
                'trademark_id' => 2,
                'size_id' => 2,
                'weight_id' => 2,
                'price' => 15000,
                'price_offer' => 13000,
                'start_at' => '2021-10-1',
                'start_offer_at' => '2021-12-2',
                'end_offer_at' => '2021-12-15',
                'weight' => '800',
                'size' => '45 * 30* 20',
                'stock' => 24,
                'other_data' => 'Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop Awsome Laptop',
            ],

            [
                'title' => 'Iphone 12 pro max',
                'content' => 'Awesome mobile',
                'photo' => 'IMG-20200817-WA0000.jpg',
                'department_id' => 1,
                'color_id' => 2,
                'trademark_id' => 1,
                'size_id' => 2,
                'weight_id' => 1,
                'price' => 22000,
                'price_offer' => null,
                'start_at' => '2021-11-20',
                'start_offer_at' => null,
                'end_offer_at' => null,
                'weight' => '1.5',
                'size' => '24 * 36 * 44',
                'stock' => 23,
                'other_data' => 'Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone Awsome mobile phone',
            ],

            [
                'title' => '10th Gen CPU',
                'content' => 'Awsome CPU',
                'photo' => 'IMG-20200817-WA0000.jpg',
                'department_id' => 3,
                'color_id' => 2,
                'trademark_id' => 3,
                'size_id' => 4,
                'weight_id' => 2,
                'price' => 125,
                'price_offer' => null,
                'start_at' => '2020-10-1',
                'start_offer_at' => null,
                'end_offer_at' => null,
                'weight' => '60',
                'size' => '12 * 12',
                'stock' => 999,
                'other_data' => 'Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU Awsome CPU',
            ],


        ];
        for ($i = 1; $i <= 10; $i++) {
            foreach ($products as $pro) {
                Product::create([
                    'title' => $pro['title'],
                    'content' => $pro['content'],
                    'photo' => $pro['photo'],
                    'department_id' => $pro['department_id'],
                    'trademark_id' => $pro['trademark_id'],
                    'color_id' => $pro['color_id'],
                    'size' => $pro['size'],
                    'size_id' => $pro['size_id'],
                    'price' => $pro['price'],
                    'start_at' => $pro['start_at'],
                    'price_offer' => $pro['price_offer'],
                    'start_offer_at' => $pro['start_offer_at'],
                    'end_offer_at' => $pro['end_offer_at'],
                    'weight' => $pro['weight'],
                    'weight_id' => $pro['weight_id'],
                    'stock' => $pro['stock'],
                    'other_data' => $pro['other_data'],
                ]);
            }
        }
    }
}
