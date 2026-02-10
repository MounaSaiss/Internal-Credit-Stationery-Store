<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        return [
            'order_id'     => $order ? $order->id : Order::factory(),
            'product_id'   => $product ? $product->id : Product::factory(),
            'quantity'     => $this->faker->numberBetween(1, 5),
            'token_price'  => $product ? $product->price : $this->faker->numberBetween(10, 100),
        ];
    }
}
