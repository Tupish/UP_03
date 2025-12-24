<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mark>
 */
class MarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value'=>fake()->numberBetween(2,5),
            'control_type' =>fake()->randomElement(['Экзамен','Зачет','Тест','Контрольная работа']),
            'date'=>fake()->dateTimeBetween('-1 year', 'now'),
            'teacher_id'=>Teacher::query()->inRandomOrder()->first()->teacher_id ?? 1,
            'student_id'=>Student::query()->inRandomOrder()->first()->student_id ?? 1,
            'subject_id'=>Subject::query()->inRandomOrder()->first()->subject_id ?? 1,

        ];
    }
}
