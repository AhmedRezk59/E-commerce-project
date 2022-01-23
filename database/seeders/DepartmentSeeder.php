<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
           
           
            [
                'name_ar' => 'أجهزة محمولة',
                'name_en' => 'Mobiles and Tablets',
                'parent' => null
            ],
           
            [
                'name_ar' => 'لابتوب',
                'name_en' => 'Laptops',
                'parent' => null
            ],
            [
                'name_ar' => 'معالجات',
                'name_en' => 'CPUs',
                'parent' => null
            ],
           
            
        ];
        foreach ($departments as $m) {
            Department::create([
                'name_ar' => $m['name_ar'],
                'name_en' => $m['name_en'],
                'parent' => $m['parent']
            ]);
        }
    }
}
