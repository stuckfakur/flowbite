<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@brandingku.com',
            'street' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'regency_id' => fake()->numberBetween(1,10),
            'notes' => fake()->paragraph(1),
            'subscriber' => fake()->randomElement(['1', '0']),
            'day_id' => '0',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        \App\Models\Flower::factory(33)->create();
        $this->call(DaySeeder::class);


    }
}
