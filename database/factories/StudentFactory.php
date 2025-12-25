<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade_book'=>fake()-> bothify('#####'),
            'group_id'=>Group::query()->inRandomOrder()->first()->group_id ?? 1,
            'department_id'=>Department::query()->inRandomOrder()->first()->department_id ?? 1,
        ];
    }
}
