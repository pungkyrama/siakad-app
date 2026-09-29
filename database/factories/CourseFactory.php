<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'code' => fake()->unique()->bothify('MK-####'),
            'name' => fake()->randomElement(['Algoritma dan Pemrograman', 'Struktur Data', 'Basis Data', 'Jaringan Komputer', 'Kalkulus', 'Aljabar Linear', 'Matematika Diskrit', 'Pancasila', 'Kewarganegaraan', 'Pendidikan Agama', 'Bahasa Indonesia', 'Kecerdasan Buatan', 'Sistem Operasi', 'Rekayasa Perangkat Lunak', 'Analisis dan Perancangan Sistem']),
            'credits' => fake()->numberBetween(1, 4),
        ];
    }
}
