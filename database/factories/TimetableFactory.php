<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timetable>
 */
class TimetableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day_number'=>fake()->numberBetween(1,6),
            'lesson_number'=>fake()->numberBetween(1,7),
            'room'=>fake()->bothify('###'),
            'group_id'=>Group::query()->inRandomOrder()->first()->group_id ?? 1,
            'subject_id'=>Subject::query()->inRandomOrder()->first()->subject_id ?? 1,
            'teacher_id'=>Teacher::query()->inRandomOrder()->first()->teache_id ?? 1,
        ];
    }
}
