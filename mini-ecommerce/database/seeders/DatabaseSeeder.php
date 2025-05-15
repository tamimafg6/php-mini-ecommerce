<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Create an admin user
        User::factory()->create([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'is_admin' => true,
            'password' => bcrypt('password'),
        ]);

        // 2. Create some customers
        User::factory(5)->create();

        // 3. Create products
        Product::factory(20)->create();

        // 4. Create orders with items
        Order::factory(10)
            ->create()
            ->each(function (Order $order) {
                // pick 1–5 random products per order
                $products = Product::inRandomOrder()->take(rand(1,5))->get();
                $total    = 0;

                foreach ($products as $product) {
                    $qty = rand(1,3);

                    $order->items()->create([
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'price'      => $product->price,
                    ]);

                    $total += $product->price * $qty;

                    // reduce stock
                    $product->decrement('stock_quantity', $qty);
                }

                // update order total
                $order->update([ 'total_amount' => $total ]);
            });
    }
}
