<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = \App\Models\Faculty::all();
        return view('faculties.index', compact('faculties'));
    }

    public function create()
    {
        return view('faculties.create');
    }

    public function store(Request $request)
    {
        \App\Models\Faculty::create($request->all());
        return redirect()->route('faculties.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $faculty->update($request->all());
        return redirect()->route('faculties.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Data berhasil dihapus.');
    }
}
