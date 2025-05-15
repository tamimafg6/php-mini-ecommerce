<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        // pick an existing product at runtime
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        return [
            'order_id'   => Order::factory(),
            'product_id' => $product->id,
            'quantity'   => $this->faker->numberBetween(1, 5),
            'price'      => $product->price,
        ];
    }
}
