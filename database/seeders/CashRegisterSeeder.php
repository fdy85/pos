<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use App\Models\CashRegister;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nums = [1,2,3,4,5,6,7,8,9,10];

        foreach($nums as $num){
            $branch = BranchOffice::all()->random();
            CashRegister::create([
                                    'name' => 'Caja Registradora '.$num.' '.$branch->name,
                                    'branch_office_id' => $branch->id,
            ]);
        }        
    }
}
