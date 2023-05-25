<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subtotal = $this->faker->rand(50, 1200);
        $iva = $subtotal * .16;
        $total = $subtotal + $iva;
        $cash = 1500;
        $change = $cash - $total;
        return [
            //foreach($cashouts as $cashout){
                'qty' => 2,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                'cash' => $cash,
                'change' => $change,
                'user_id' => Auth::id()
        ];
    }
}
