<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name' => 'Globos',
            'slug' =>  Str::slug('Globos'),
            'description' => 'Globo redondo de latex',
            'barcode' => 'producto 1',
            'type' => 'PRODUCT',
            'cost' => .50,
            'price' => 2.20,
            'qty' => 300,
            'category_id' => 1,
            'brand_id' => 2
        ]);
        Product::create([
            'name' => 'Bolsitas para Dulces',
            'slug' =>  Str::slug('Bolsitas para Dulces'),
            'description' => 'Bolsa de plástico biodegradable',
            'barcode' => 'producto 2',
            'type' => 'PRODUCT',
            'cost' => 1.50,
            'price' => 2.20,
            'qty' => 300,
            'category_id' => 1,
            'brand_id' => 1
        ]);
        Product::create([
            'name' => 'Vela reveladora',
            'slug' =>  Str::slug('Vela reveladora'),
            'description' => 'Vela Reveladora de Genero',
            'barcode' => 'producto 3',
            'type' => 'PRODUCT',
            'cost' => 25,
            'price' => 50,
            'qty' => 30,
            'category_id' => 1,
            'brand_id' => 2
        ]);
        Product::create([
            'name' => 'Globo con gas personalizado',
            'slug' =>  Str::slug('Globo con gas personalizado'),
            'description' => 'Globo grande personalizado con Hielo',
            'barcode' => 'producto 4',
            'type' => 'PRODUCT',
            'cost' => 50,
            'price' => 75,
            'qty' => 150,
            'category_id' => 1,
            'brand_id' => 2
        ]);
        Product::create([
            'name' => 'Reloj',
            'slug' =>  Str::slug('Reloj'),
            'description' => 'Reloj Casual',
            'barcode' => 'producto 5',
            'type' => 'PRODUCT',
            'cost' => 600,
            'price' => 750,
            'qty' => 15,
            'category_id' => 2,
            'brand_id' => 3
        ]);
        Product::create([
            'name' => 'Vela Aromatica',
            'slug' =>  Str::slug('Vela Aromatica'),
            'description' => 'Vela Aromática de Canela',
            'barcode' => 'producto 6',
            'type' => 'PRODUCT',
            'cost' => 120,
            'price' => 180,
            'qty' => 50,
            'category_id' => 2,
            'brand_id' => 4
        ]);
        Product::create([
            'name' => 'Regla',
            'slug' =>  Str::slug('Regla'),
            'description' => 'Regla 30 cm',
            'barcode' => 'producto 7',
            'type' => 'PRODUCT',
            'cost' => 10,
            'price' => 18,
            'qty' => 50,
            'category_id' => 3,
            'brand_id' => 5
        ]);
        Product::create([
            'name' => 'Marcador',
            'slug' =>  Str::slug('Marcador'),
            'description' => 'Marcador grueso',
            'barcode' => 'producto 8',
            'type' => 'PRODUCT',
            'cost' => 10,
            'price' => 22,
            'qty' => 100,
            'category_id' => 3,
            'brand_id' => 5
        ]);
        Product::create([
            'name' => 'Cartulina',
            'slug' =>  Str::slug('Cartulina'),
            'description' => 'Cartulina 60x100 cm',
            'barcode' => 'producto 9',
            'type' => 'PRODUCT',
            'cost' => 5,
            'price' => 15,
            'qty' => 500,
            'category_id' => 3,
            'brand_id' => 6
        ]);
        Product::create([
            'name' => 'Lona',
            'slug' =>  Str::slug('Lona'),
            'description' => 'Lona para espectacular 150x300 cm',
            'barcode' => 'producto 10',
            'type' => 'PRODUCT',
            'cost' => 5,
            'price' => 15,
            'qty' => 500,
            'category_id' => 4,
            'brand_id' => 7
        ]);
        Product::create([
            'name' => 'Camisetas',
            'slug' =>  Str::slug('Camisetas'),
            'description' => 'Camiseta estampada',
            'barcode' => 'producto 11',
            'type' => 'PRODUCT',
            'cost' => 25,
            'price' => 120,
            'qty' => 1500,
            'category_id' => 4,
            'brand_id' => 8
        ]);


        /* SERVICES */
        Product::create([
            'name' => 'Instalación de Lona Chica',
            'slug' =>  Str::slug('Instalación de Lona Chica'),
            'description' => 'Instalación de lona chica 2x4',
            'barcode' => 'Servicio 1',
            'type' => 'Service',
            'cost' => 0,
            'price' => 180,
            'qty' => 0,
            'category_id' => 1,
            'brand_id' => 1
        ]);

        /* SERVICES */
        Product::create([
            'name' => 'Instalación de Lona Grande',
            'slug' =>  Str::slug('Instalación de Lona Grande'),
            'description' => 'Instalación de lona Grande 8x12',
            'barcode' => 'Servicio 2',
            'type' => 'Service',
            'cost' => 0,
            'price' => 350,
            'qty' => 0,
            'category_id' => 1,
            'brand_id' => 1
        ]);
        /* SERVICES */
        Product::create([
            'name' => 'Envío',
            'slug' =>  Str::slug('Envío'),
            'description' => 'Envío de mercancía',
            'barcode' => 'Servicio 3',
            'type' => 'Service',
            'cost' => 0,
            'price' => 40,
            'qty' => 0,
            'category_id' => 1,
            'brand_id' => 1
        ]);
    }
}
