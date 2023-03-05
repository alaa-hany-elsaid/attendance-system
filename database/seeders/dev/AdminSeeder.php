<?php

namespace Database\Seeders\dev;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::factory(2, [
            'role' => 'admin',
        ])->create();
    }
}
