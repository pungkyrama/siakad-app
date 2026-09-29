<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'academic_year_id' => AcademicYear::factory(),
            'amount' => fake()->randomFloat(2, 1000000, 10000000),
            'status' => fake()->randomElement(['Unpaid', 'Paid']),
        ];
    }
}
