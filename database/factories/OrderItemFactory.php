<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
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
        $qty = fake()->numberBetween(1, 5);
        $price = fake()->numberBetween(15000, 150000);

        return [
            'order_id' => Order::factory(),
            'menu_id' => Menu::factory()->state(['price' => $price]),
            'qty' => $qty,
            'subtotal' => $qty * $price,
        ];
    }
}
