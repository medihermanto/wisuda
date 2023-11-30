<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::create([
            'id' => '1',
            'name' => 'FEB',
        ]);
        Faculty::create([
            'id' => '2',
            'name' => 'TEKNIK',
        ]);
        Faculty::create([
            'id' => '3',
            'name' => 'FISIPOL',
        ]);
        Faculty::create([
            'id' => '4',
            'name' => 'PERTANIAN',
        ]);
        Faculty::create([
            'id' => '5',
            'name' => 'FBS',
        ]);
        Faculty::create([
            'id' => '6',
            'name' => 'FKIP',
        ]);
    }
}
