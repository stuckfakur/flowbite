<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'street' => $this->faker->streetName(),
            'phone' => $this->faker->phoneNumber(),
            'regency_id' => $this->faker->randomNumber(),
            'subscriber' => $this->faker->boolean(),
            'day_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
