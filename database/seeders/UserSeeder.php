<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::Create([
            'name' => 'José Alfredo Dorado Escobedo',
            'email' => 'adorado@ctdi.com',
            'cel' => '653555544354',
            'password' => Hash::make('asdasdasd'),
            'status' => 1,
            'level' => 'SuperAdmin',
            'branch_office_id' => 1,
        ])->assignRole('SuperAdmin');
        
        User::Create([
            'name' => 'Lupita',
            'email' => 'lupita@lamasbonita.com',
            'cel' => '653',
            'password' => Hash::make('asdasdasd'),
            'status' => 1,
            'level' => 'Cajero',
            'branch_office_id' => 1,
        ])->assignRole('Cajero'); 
        //User::factory(4)->create();
    }
}
