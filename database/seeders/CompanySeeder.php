<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::create([
            'name' => 'Empresa Fulanita SA de CV',
            'address' => 'Nuevo León y 25 #2500',
            'rfc' => 'FU58JLIFMV52'
        ]);
    }
}
