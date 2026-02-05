<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'total_price' => $this->faker->randomFloat(2, 20, 2000),
            'code' => strtoupper($this->faker->bothify('ORD-#####')),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
