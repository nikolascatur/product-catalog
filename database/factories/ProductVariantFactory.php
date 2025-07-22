<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_variant' => $this->faker->words(2, true),
        'weight' => $this->faker->numberBetween(100, 5000), // gram
        'selling_price' => $this->faker->numberBetween(10000, 1000000),
        'base_price' => $this->faker->numberBetween(5000, 999999),
        'product_stock' => $this->faker->numberBetween(0, 1000),
        'barcode' => $this->faker->unique()->ean13,
        ];
    }
}
