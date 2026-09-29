<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\ClassSchedule;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Invoice;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Lecturer;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
        ]);

        $this->command->info('Membuat Tahun Akademik dan Ruangan...');
        $academicYears = AcademicYear::factory()->count(2)->create();
        $rooms = Room::factory()->count(10)->create();

        $this->command->info('Membuat Fakultas dan Program Studi...');
        $faculties = Faculty::factory()->count(3)->create();

        $departments = collect();
        foreach ($faculties as $faculty) {
            $facultyDepartments = Department::factory()->count(3)->create([
                'faculty_id' => $faculty->id,
            ]);
            $departments = $departments->merge($facultyDepartments);
        }

        $this->command->info('Membuat Mata Kuliah, Dosen, dan Mahasiswa...');
        $allCourses = collect();
        $allLecturers = collect();
        $allStudents = collect();

        foreach ($departments as $department) {
            $allCourses = $allCourses->merge(Course::factory()->count(5)->create(['department_id' => $department->id]));
            $allLecturers = $allLecturers->merge(Lecturer::factory()->count(3)->create(['department_id' => $department->id]));
            $allStudents = $allStudents->merge(Student::factory()->count(10)->create(['department_id' => $department->id]));
        }

        $this->command->info('Membuat Jadwal Kelas...');
        $classSchedules = collect();
        foreach ($allCourses as $course) {
            foreach ($academicYears as $academicYear) {
                
                $lecturersInDept = $allLecturers->where('department_id', $course->department_id);
                if ($lecturersInDept->isEmpty()) {
                    continue;
                }

                $schedule = ClassSchedule::factory()->create([
                    'course_id' => $course->id,
                    'lecturer_id' => $lecturersInDept->random()->id,
                    'academic_year_id' => $academicYear->id,
                    'room_id' => $rooms->random()->id,
                ]);
                $classSchedules->push($schedule);
            }
        }

        $this->command->info('Membuat KRS, Nilai, Tagihan, dan Pembayaran...');
        foreach ($allStudents as $student) {
            foreach ($academicYears as $academicYear) {
                
                $invoice = Invoice::factory()->create([
                    'student_id' => $student->id,
                    'academic_year_id' => $academicYear->id,
                ]);

                if ($invoice->status === 'Paid') {
                    Payment::factory()->create([
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->amount,
                    ]);
                }

               
                $krs = Krs::factory()->create([
                    'student_id' => $student->id,
                    'academic_year_id' => $academicYear->id,
                ]);

                
                $schedulesInYear = $classSchedules->where('academic_year_id', $academicYear->id);
                if ($schedulesInYear->count() >= 3) {
                    $randomSchedules = $schedulesInYear->random(3);

                    foreach ($randomSchedules as $schedule) {
                        $krsDetail = KrsDetail::factory()->create([
                            'krs_id' => $krs->id,
                            'class_schedule_id' => $schedule->id,
                        ]);

                       
                        Grade::factory()->create([
                            'krs_detail_id' => $krsDetail->id,
                        ]);
                    }
                }
            }
        }

        $this->command->info('Database seeding selesai dengan sukses!');
    }
}
