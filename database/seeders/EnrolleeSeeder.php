<?php

namespace Database\Seeders;

use App\Models\Enrollee;
use Illuminate\Database\Seeder;

class EnrolleeSeeder extends Seeder
{
    public function run(): void
    {
        Enrollee::create([
            'student_id' => '230001',
            'name' => 'Juan Dela Cruz',
            'course' => 'BSIT',
            'year' => 3,
            'block' => 'A'
        ]);

        Enrollee::create([
            'student_id' => '230002',
            'name' => 'Maria Clara',
            'course' => 'BSCS',
            'year' => 2,
            'block' => 'B'
        ]);
    }
}