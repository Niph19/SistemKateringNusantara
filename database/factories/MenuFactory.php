<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    private const NAMES = [
        'Nasi Ayam Bakar',
        'Nasi Rendang',
        'Nasi Gudeg',
        'Nasi Liwet',
        'Nasi Uduk',
        'Ayam Woku',
        'Ayam Rica-Rica',
        'Sate Ayam',
        'Sate Lilit',
        'Ikan Bakar Rica',
        'Ikan Pesmol',
        'Soto Ayam',
        'Rawon Sapi',
        'Gado-Gado',
        'Urap Sayur',
        'Perkedel Kentang',
        'Tempe Orek',
        'Sambal Matah',
        'Lemper Ayam',
        'Pastel Sayur',
        'Risoles Mayo',
        'Klepon',
        'Puding Cokelat',
        'Es Teh Manis',
        'Es Jeruk',
        'Jus Alpukat',
        'Lontong Sayur',
        'Tumpeng Mini',
        'Sup Buntut',
        'Semur Jengkol',
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
            'price' => fake()->numberBetween(15000, 150000),
            'category_id' => Category::factory(),
        ];
    }
}
