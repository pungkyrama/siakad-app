<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = \App\Models\Department::with(['faculty'])->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $faculties = \App\Models\Faculty::all();
        return view('departments.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        \App\Models\Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Department $department)
    {
        $faculties = \App\Models\Faculty::all();
        return view('departments.edit', compact('department', 'faculties'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Data berhasil dihapus.');
    }
}
