<?php

namespace Database\Seeders\dev;

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(ProfessorSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
