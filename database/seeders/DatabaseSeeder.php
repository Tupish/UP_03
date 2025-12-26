<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Role;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->count(2)->standartRoles()->create();
        Group::factory(10)->create();
        Department::factory(5)->create();


        User::factory(15)->create(['role_id' => 2])->each(function ($user) {
            Teacher::create([
                'id' => $user->id
            ]);
        });


        Subject::factory(20)->create();


        User::factory(100)->create(['role_id' => 1])->each(function ($user) {

            $group = Group::inRandomOrder()->first();
            $dept = Department::inRandomOrder()->first();

            Student::create([
                'id' => $user->id,
                'grade_book' => fake()->unique()->numberBetween(10000, 99999),
                'group_id' => $group->id ?? $group->group_id,
                'department_id' => $dept->id ?? $dept->department_id,
            ]);
        });

        Timetable::factory(50)->create();
        Mark::factory(400)->create();
    }
}
