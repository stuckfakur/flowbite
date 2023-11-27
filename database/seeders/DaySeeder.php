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
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Selasa',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Rabu',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Kamis',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Jumat',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Sabtu',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => 'Minggu',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);
        Day::create([
           'name'       => '-',
           'start_date' => '',
           'end_date'   => '',
           'type'       => 'based'
        ]);


    }
}
