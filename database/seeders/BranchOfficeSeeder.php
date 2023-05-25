<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BranchOffice::create([
            'name' => 'Globitos y Más',
            'address' => 'Nuevo León y 25 #2500',
            'phone' => '6531192629',
            'company_id' =>1,
        ]);
        BranchOffice::create([
            'name' => 'Globitos y Más Centro',
            'address' => 'Obregón y 7 #700',
            'phone' => '6535346510',
            'company_id' =>1,
        ]);
    }
}
