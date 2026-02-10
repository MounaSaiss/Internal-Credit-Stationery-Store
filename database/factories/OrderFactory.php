<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array{
    return [
        'user_id' => User::factory(),
        'status' => 'approved',
        'total_price' => fake()->numberBetween(50, 1000),
        'code' => 'ORD-' . fake()->unique()->numberBetween(10000000, 999999999),
        ];}
}
<<<<<<< HEAD
=======

>>>>>>> 071c699561c6d8db6871fee8b4164aa7bd6b42f1
