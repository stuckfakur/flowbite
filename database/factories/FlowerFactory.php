<?php

namespace Database\Factories;

use App\Models\Flower;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FlowerFactory extends Factory
{
    protected $model = Flower::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomElement(['75000', '100000','125000']),
            'type' => $this->faker->randomElement(['normal', 'additional']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
