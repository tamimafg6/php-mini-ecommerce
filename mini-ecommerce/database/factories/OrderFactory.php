<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $paymentTypes = ['Credit Card','PayPal','Cash on Delivery'];
        return [
            'user_id'      => User::factory(),
            'name'         => $this->faker->name(),
            'email'        => $this->faker->safeEmail(),
            'address'      => $this->faker->address(),
            'payment_type' => $this->faker->randomElement($paymentTypes),
            // total_amount will be set in seeder after items are created
            'total_amount' => 0,
        ];
    }
}
