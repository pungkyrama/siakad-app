<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\ClassSchedule;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassSchedule>
 */
class ClassScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'lecturer_id' => Lecturer::factory(),
            'academic_year_id' => AcademicYear::factory(),
            'room_id' => Room::factory(),
            'day_of_week' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']),
            'start_time' => fake()->time('H:i'),
            'end_time' => fake()->time('H:i'),
        ];
    }
}
