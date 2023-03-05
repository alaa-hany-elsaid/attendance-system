<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    public function definition(): array
    {
        $start_date = Carbon::now()->addDays(random_int(1, 90));
        return [
            'start_date'  => $start_date,
            'end_date'    => $start_date->addMinutes(120),
            'title'       => fake()->text(50),
            'abstraction' => fake()->text(300),
        ];
    }
}
