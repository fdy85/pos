<?php

namespace Database\Factories;

use App\Models\CashRegister;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CashoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'date' => Carbon::now()->format('d-m-Y'),
            'cash_start' => rand(20,2500),
            'total' => rand(5000, 10000),
            'status' => 1,
            'user_id' => User::all()->random()->id,
            'cash_register_id' => CashRegister::all()->random()->id,
            'branch_office_id' => 1,
            'reviewed_by' => 1
        ];
    }
}
