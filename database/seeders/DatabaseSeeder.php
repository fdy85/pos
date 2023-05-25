<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* File::deleteDirectories();
        File::makeDirectory('products');
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products'); */

        $this->call(CompanySeeder::class);
        $this->call(BranchOfficeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(BrandsSeeder::class);
        $this->call(BrandCategorySeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProviderSeeder::class);
        //$this->call(ImageSeeder::class);
        //$this->call(DenominationSeeder::class);
        $this->call(CashRegisterSeeder::class);
        $this->call(CashoutSeeder::class);
    }
}
