<?php

namespace Database\Seeders;

use App\Models\Denomination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $denominations = [
            ['type' => 'coin',
            'value' => .50,
            'icon' => '<i class="fas fa-circle"></i>'],
            ['type' => 'coin',
            'value' => 1,
            'icon' => '<i class="fas fa-circle"></i>'],
            ['type' => 'coin',
            'value' => 2,
            'icon' => '<i class="fas fa-circle"></i>'],
            ['type' => 'coin',
            'value' => 5,
            'icon' => '<i class="fas fa-circle"></i>'],
            ['type' => 'coin',
            'value' => 10,
            'icon' => '<i class="fas fa-circle"></i>'],
            ['type' => 'bill',
            'value' => 20,
            'icon' => '<i class="fas fa-money-bill"></i>'],
            ['type' => 'bill',
            'value' => 50,
            'icon' => '<i class="fas fa-money-bill"></i>'],
            ['type' => 'bill',
            'value' => 100,
            'icon' => '<i class="fas fa-money-bill"></i>'],
            ['type' => 'bill',
            'value' => 200,
            'icon' => '<i class="fas fa-money-bill"></i>'],
            ['type' => 'bill',
            'value' => 500,
            'icon' => '<i class="fas fa-money-bill"></i>'],
        ];

        foreach($denominations as $d){
            Denomination::create($d);
        }

        
    }
}
