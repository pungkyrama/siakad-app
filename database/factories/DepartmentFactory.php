<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ugmProdi = [
            'Ilmu Komputer',
            'Teknologi Informasi',
            'Kedokteran',
            'Farmasi',
            'Biologi',
            'Teknik Sipil',
            'Teknik Mesin',
            'Teknik Industri',
            'Hukum',
            'Psikologi',
            'Manajemen',
            'Akuntansi',
            'Ilmu Ekonomi',
            'Sosiologi',
            'Ilmu Komunikasi',
            'Hubungan Internasional',
            'Arsitektur',
            'Pariwisata',
            'Kehutanan',
            'Pertanian'
        ];

        return [
            'faculty_id' => Faculty::factory(),
            'name' => fake()->randomElement($ugmProdi) . ' ' . fake()->optional()->numberBetween(1, 99),
            'degree_level' => fake()->randomElement(['S1', 'D3']),
        ];
    }
}
