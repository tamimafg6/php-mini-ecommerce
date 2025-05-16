<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Tech Pro Smartphone',
                'category_id' => 1,
                'description' => 'Latest smartphone with high-end features',
                'price' => 999.99,
                'stock_quantity' => 50
            ],
            [
                'name' => 'UltraBook Laptop',
                'category_id' => 2,
                'description' => 'Lightweight laptop with powerful specs',
                'price' => 1299.99,
                'stock_quantity' => 30
            ],
            [
                'name' => 'Premium Tablet',
                'category_id' => 3,
                'description' => '10-inch tablet with retina display',
                'price' => 499.99,
                'stock_quantity' => 45
            ],
            [
                'name' => 'Wireless Earbuds',
                'category_id' => 4,
                'description' => 'Noise-cancelling wireless earbuds',
                'price' => 129.99,
                'stock_quantity' => 100
            ],
            [
                'name' => 'Smart Speaker',
                'category_id' => 5,
                'description' => 'Voice-controlled smart speaker',
                'price' => 79.99,
                'stock_quantity' => 60
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
