<?php

namespace Database\Factories;

use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DayFactory extends Factory
{
    protected $model = Day::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->dayOfWeek(),
            'start_date' => $this->faker->dateTimeBetween($startDate = '-7 days', $endDate = '-4 days'),
            'end_date' => $this->faker->dateTimeBetween($startDate = '-4 days', $endDate = 'now'),
            'type' => $this->faker->randomElement(['based', 'order']),
            'slug' => $this->faker->slug(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
