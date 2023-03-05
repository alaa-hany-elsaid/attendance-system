<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'            => fake()->text(30),
            'total_grade'     => fake()->boolean() ? 150 : 100,
            'user_id'         => $this->state('user_id'),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Subject $subject) {
            $subject->lectures()->saveMany(Lecture::factory(12)->make());
        });
    }
}
