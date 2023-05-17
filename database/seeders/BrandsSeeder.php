<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Brand::create([
            'name' => 'SuperBags'
        ]);
        Brand::create([
            'name' => 'Baloon'
        ]);
        Brand::create([
            'name' => 'Casio'
        ]);
        Brand::create([
            'name' => 'Smell'
        ]);
        Brand::create([
            'name' => 'Bic'
        ]);
        Brand::create([
            'name' => 'Papper'
        ]);
        Brand::create([
            'name' => 'Durable'
        ]);
        Brand::create([
            'name' => 'Patito'
        ]);
    }
}
