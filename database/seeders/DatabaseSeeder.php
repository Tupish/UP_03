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
        Teacher::factory(15)->create();
        Subject::factory(20)->create();
        Student::factory(100)->create();
        Timetable::factory(50)->create();
        Mark::factory(400)->create();
        User::factory(115)->create();
    }
}
