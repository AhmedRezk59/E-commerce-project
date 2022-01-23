<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            WeightSeeder::class,
            DepartmentSeeder::class,
            ColorSeeder::class,
            TrademarkSeeder::class,
            SizeSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}