<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassSchedule;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Room;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    public function index()
    {
        $schedules = ClassSchedule::with(['course', 'lecturer.user', 'room', 'academicYear'])->orderBy('updated_at', 'desc')->get();

        return view('class-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $courses = Course::all();
        $lecturers = Lecturer::with('user')->get();
        $academicYears = AcademicYear::where('is_active', 1)->get();
        $rooms = Room::all();

        return view('class-schedules.create', compact('courses', 'lecturers', 'academicYears', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'room_id' => 'required|exists:rooms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        ClassSchedule::create($validated);

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(ClassSchedule $class_schedule)
    {
        $courses = Course::all();
        $lecturers = Lecturer::with('user')->get();
        $academicYears = AcademicYear::where('is_active', 1)->get();
        $rooms = Room::all();

        return view('class-schedules.edit', compact('class_schedule', 'courses', 'lecturers', 'academicYears', 'rooms'));
    }

    public function update(Request $request, ClassSchedule $class_schedule)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'room_id' => 'required|exists:rooms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $class_schedule->update($validated);

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal berhasil diubah.');
    }

    public function destroy(ClassSchedule $class_schedule)
    {
        $class_schedule->delete();

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal dihapus.');
    }
}
