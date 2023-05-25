<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
            'name' => 'Servicios',
            'slug' =>  Str::slug('Servicios'),
            'icon' => '<i class="fas fa-th-large"></i>'
            ],
            [
            'name' => 'Fiesta',
            'slug' =>  Str::slug('Fiesta'),
            'icon' => '<i class="fas fa-th-large"></i>'
            ],
            [
            'name' => 'Miscelanea',
            'slug' =>  Str::slug('Miscelanea'),
            'icon' => '<i class="fas fa-th-large"></i>'
            ],
            [
            'name' => 'Oficina',
            'slug' =>  Str::slug('Oficina'),
            'icon' => '<i class="fas fa-th-large"></i>'
            ],
            [
            'name' => 'Serigrafía',
            'slug' =>  Str::slug('Serigrafía'),
            'icon' => '<i class="fas fa-th-large"></i>'
            ],
            
        ];


        foreach($categories as $category){
            $cat = Category::create($category)->first();
        }
    }
}
