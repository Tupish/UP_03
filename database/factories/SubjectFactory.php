<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_name' => fake()->unique()->randomElement([
                'Математика',
                'Физика',
                'Химия',
                'Информатика',
                'Программирование',
                'Базы данных',
                'Сетевые технологии',
                'Веб-разработка',
                'Английский язык',
                'Русский язык',
                'История',
                'Экономика',
                'Бухгалтерский учет',
                'Право',
                'Электротехника',
                'Механика',
                'Черчение',
                'Архитектура',
                'Дизайн',
                'Психология',
                'Философия',
                'Физкультура',
                'ОБЖ',
                'Статистика',
                'Менеджмент',
                'Маркетинг',
                'Логистика',
                'Экология',
                'Биология',
                'География'
            ]),
            'teacher_id'=>Teacher::query()->inRandomOrder()->first()->teacher_id ?? 1,
        ];
    }
}
