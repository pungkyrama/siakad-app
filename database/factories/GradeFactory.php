<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\KrsDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'krs_detail_id' => KrsDetail::factory(),
            'numeric_score' => fake()->randomFloat(2, 0, 100),
            'letter_grade' => fake()->randomElement(['A', 'B', 'C', 'D', 'E']),
        ];
    }
}
