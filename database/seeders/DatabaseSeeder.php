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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Сначала справочники (они ни от кого не зависят)
        Role::factory()->count(2)->standartRoles()->create();
        Group::factory(10)->create();
        Department::factory(5)->create();

        // 2. Создаем тестового пользователя для входа
        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@test.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);

        // 3. Создаем Юзеров-Преподавателей и записываем в teachers
        User::factory(15)->create(['role_id' => 2])->each(function ($user) {
            Teacher::create([
                'user_id' => $user->id
            ]);
        });

        // 4. Предметы
        Subject::factory(20)->create();

        // 5. Создаем Юзеров-Студентов и привязываем к группам
        User::factory(100)->create(['role_id' => 1])->each(function ($user) {
            // Пытаемся найти ID группы и департамента (учитывая возможные разные названия колонок)
            $group = Group::inRandomOrder()->first();
            $department = Department::inRandomOrder()->first();

            $groupId = $group->id ?? $group->group_id ?? null;
            $deptId = $department->id ?? $department->department_id ?? null;

            if ($groupId && $deptId) {
                Student::create([
                    'user_id' => $user->id,
                    'grade_book' => fake()->unique()->numberBetween(10000, 99999),
                    'group_id' => $groupId,
                    'department_id' => $deptId,
                ]);
            }
        });

        // 6. Остальное (расписание и оценки)
        Timetable::factory(50)->create();
        Mark::factory(100)->create();
    }
}
