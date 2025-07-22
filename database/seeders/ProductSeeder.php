<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $batchSize = 1000; // proses bertahap agar tidak overload memory
        $totalProducts = 100000;

        for ($i = 0; $i < $totalProducts; $i += $batchSize) {
            $products = [];

            // 1. Generate batch of products
            for ($j = 0; $j < $batchSize; $j++) {
                $products[] = [
                    'id' => \Illuminate\Support\Str::uuid(),
                    'name' => $faker->words(3, true),
                    'category' => $faker->randomElement(['electronics', 'fashion', 'home', 'toys', 'books']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // 2. Insert products
            Product::insert($products);

            // 3. Generate variants for each
            $variants = [];
            foreach ($products as $product) {
                $variantCount = rand(2, 5);
                for ($k = 0; $k < $variantCount; $k++) {
                    $variants[] = [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'product_id' => $product['id'],
                        'name_variant' => $faker->words(2, true),
                        'weight' => $faker->numberBetween(100, 5000),
                        'selling_price' => $faker->numberBetween(10000, 1000000),
                        'base_price' => $faker->numberBetween(5000, 900000),
                        'product_stock' => $faker->numberBetween(0, 1000),
                        'barcode' => $faker->unique()->ean13,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            ProductVariant::insert($variants);

            echo "Inserted: " . ($i + $batchSize) . " products\r";
        }
    }
}
