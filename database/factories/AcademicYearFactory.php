<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = fake()->year();

        return [
            'name' => $year.'/'.($year + 1),
            'semester' => fake()->randomElement(['Ganjil', 'Genap']),
            'is_active' => fake()->boolean(20),
        ];
    }
}
