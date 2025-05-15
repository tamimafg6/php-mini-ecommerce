<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $categories = ['Smartphone','Laptop','Tablet','Accessory','Wearable','Audio'];
        return [
            'name'           => $this->faker->word() . ' ' . $this->faker->randomElement(['Pro','X','Max','Lite']),
            'category'       => $this->faker->randomElement($categories),
            'description'    => $this->faker->paragraph(),
            'price'          => $this->faker->randomFloat(2, 20, 1000),
            'image'          => null, // or use: $this->faker->imageUrl(640,480,'technics',true)
            'stock_quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
