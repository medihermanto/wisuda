<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departement::create([
            'faculty_id' => '1',
            'name' => 'Akuntansi',
        ]);
        Departement::create([
            'faculty_id' => '1',
            'name' => 'Ilmu Ekonomi',
        ]);
        Departement::create([
            'faculty_id' => '1',
            'name' => 'Manajemen',
        ]);
        Departement::create([
            'faculty_id' => '1',
            'name' => 'Administrasi Perpajakan',
        ]);
        Departement::create([
            'faculty_id' => '2',
            'name' => 'Teknik Mesin',
        ]);
        Departement::create([
            'faculty_id' => '2',
            'name' => 'Teknik Elektro',
        ]);
        Departement::create([
            'faculty_id' => '2',
            'name' => 'Teknik Sipil',
        ]);
    }
}
