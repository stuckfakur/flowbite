<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Day;
use Database\Factories\DayFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@brandingku.com',
        ]);
        \App\Models\Flower::factory(33)->create();
        $this->call(DaySeeder::class);
        \App\Models\Day::factory(23)->create();


    }
}
