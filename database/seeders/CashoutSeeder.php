<?php

namespace Database\Seeders;

use App\Models\Cashout;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CashoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cashout::factory(10)->create()->each(function($cashout){
            $subtotal = rand(50, 1200);
            $iva = $subtotal * .16;
            $total = $subtotal + $iva;
            $cash = 1500;
            $change = $cash - $total;
            Sale::create([
                    'qty' => 2,
                    'subtotal' => $subtotal,
                    'iva' => $iva,
                    'total' => $total,
                    'cash' => $cash,
                    'change' => $change,
                    'client_id' => 1,
                    'user_id' => User::all()->random()->id,
                    'cashout_id' => $cashout->id,
            ]);
        });
    }
}
