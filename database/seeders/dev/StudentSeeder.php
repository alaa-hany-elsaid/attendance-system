<?php

namespace Database\Seeders\dev;

use App\Models\Lecture;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        User::factory(50)->create();
    }
}
