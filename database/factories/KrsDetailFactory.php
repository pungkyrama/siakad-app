<?php

namespace Database\Factories;

use App\Models\ClassSchedule;
use App\Models\Krs;
use App\Models\KrsDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KrsDetail>
 */
class KrsDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'krs_id' => Krs::factory(),
            'class_schedule_id' => ClassSchedule::factory(),
        ];
    }
}
