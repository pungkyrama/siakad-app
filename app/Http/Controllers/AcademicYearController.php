<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academic_years = \App\Models\AcademicYear::all();
        return view('academic-years.index', compact('academic_years'));
    }

    public function create()
    {
        return view('academic-years.create');
    }

    public function store(Request $request)
    {
        \App\Models\AcademicYear::create($request->all());
        return redirect()->route('academic-years.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $academicYear->update($request->all());
        return redirect()->route('academic-years.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return redirect()->route('academic-years.index')->with('success', 'Data berhasil dihapus.');
    }
}
