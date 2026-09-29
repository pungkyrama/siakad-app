<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassSchedule;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    public function index()
    {
        $krs = Krs::with(['student.user', 'academicYear'])->latest('updated_at')->get();

        return view('krs.index', compact('krs'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        $academicYears = AcademicYear::where('is_active', 1)->get();
        $schedules = ClassSchedule::with(['course.department', 'lecturer.user'])
            ->whereHas('course', function ($q) {
                $q->where('name', '!=', '-');
            })
            ->get();

        return view('krs.create', compact('students', 'academicYears', 'schedules'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $krs = Krs::create(['student_id' => $request->student_id, 'academic_year_id' => $request->academic_year_id, 'status' => 'Approved']);
            if ($request->has('schedules')) {
                foreach ($request->schedules as $schedule_id) {
                    KrsDetail::create(['krs_id' => $krs->id, 'class_schedule_id' => $schedule_id]);
                }
            }
        });

        return redirect()->route('krs.index')->with('success', 'KRS berhasil diajukan.');
    }

    public function show(Krs $kr)
    {
        return abort(404);
    }

    public function edit(Krs $kr)
    {
        return abort(404);
    }

    public function update(Request $request, Krs $kr)
    {
        return abort(404);
    }

    public function destroy(Krs $kr)
    {
        $kr->delete();

        return redirect()->route('krs.index');
    }
}
