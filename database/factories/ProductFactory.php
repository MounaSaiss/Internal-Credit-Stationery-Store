<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraphs(3, true),
            'image'=> fake()->imageUrl(800 , 600 , 'news'),
            'price'=> fake()->numberBetween(0 , 1000),
            'stock'=> fake()->numberBetween(0 , 100),
            'type'=> fake()->randomElement(['premium' , 'standard']),
        ];
    }
}
