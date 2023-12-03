<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create([
           'name'       => 'Senin',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Selasa',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Rabu',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Kamis',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Jumat',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Sabtu',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Minggu',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => '-',
           'start_date' => '2023-01-01',
           'end_date'   => '2023-01-01',
           'type'       => 'based'
        ]);


    }
}
