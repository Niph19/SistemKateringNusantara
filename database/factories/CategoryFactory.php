<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    private const NAMES = [
        'Pembuka',
        'Utama',
        'Penutup',
        'Minuman',
        'Camilan',
        'Nasi Box',
        'Prasmanan',
        'Tumpeng',
        'Paket Hemat',
        'Dessert',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(self::NAMES),
        ];
    }
}
