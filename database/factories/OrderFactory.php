<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'member_id' => $this->faker->numberBetween(1,10),
            'orderBy' => $this->faker->name(gender: 'male'),
            'day_id' => $this->faker->numberBetween(9,11),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
