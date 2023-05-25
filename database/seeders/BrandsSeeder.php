<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


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
            'name' => 'Servicios',
            'slug' =>  Str::slug('Servicios'),
        ]);
        
        Brand::create([
            'name' => 'SuperBags',
            'slug' =>  Str::slug('SuperBags'),
        ]);
        Brand::create([
            'name' => 'Baloon',
            'slug' =>  Str::slug('Baloon'),
        ]);
        Brand::create([
            'name' => 'Casio',
            'slug' =>  Str::slug('Casio'),
        ]);
        Brand::create([
            'name' => 'Smell',
            'slug' =>  Str::slug('Smell'),
        ]);
        Brand::create([
            'name' => 'Bic',
            'slug' =>  Str::slug('Bic'),
        ]);
        Brand::create([
            'name' => 'Papper',
            'slug' =>  Str::slug('Papper'),
        ]);
        Brand::create([
            'name' => 'Durable',
            'slug' =>  Str::slug('Durable'),
        ]);
        Brand::create([
            'name' => 'Patito',
            'slug' =>  Str::slug('Patito'),
        ]);
    }
}
