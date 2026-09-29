<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = \App\Models\Course::with(['department'])->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = \App\Models\Department::all();
        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required',
            'credits' => 'required|integer',
            'department_id' => 'required|exists:departments,id'
        ]);

        \App\Models\Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        $departments = \App\Models\Department::all();
        return view('courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required',
            'credits' => 'required|integer',
            'department_id' => 'required|exists:departments,id'
        ]);

        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Data berhasil dihapus.');
    }
}
