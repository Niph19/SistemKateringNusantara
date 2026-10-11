<?php

namespace Database\Factories;

use App\Models\Courier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
            'customer_id' => Customer::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'courier_id' => Courier::factory(),
            'status' => fake()->randomElement(['menunggu', 'diproses', 'dikirim', 'selesai']),
        ];
    }
}
