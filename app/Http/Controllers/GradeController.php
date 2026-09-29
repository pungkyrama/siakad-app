<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\KrsDetail;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $krsDetails = KrsDetail::with(['krs.student.user', 'classSchedule.course', 'grade'])
            ->has('classSchedule.course')
            ->whereHas('classSchedule.course', function ($query) {
                $query->where('name', '!=', '-');
            })
            ->has('krs.student.user')
            ->whereHas('krs.student', function ($query) {
                $query->where('nim', '!=', '-');
            })
            ->whereHas('krs.student.user', function ($query) {
                $query->where('name', '!=', '-');
            })
            ->get();

        return view('grades.index', compact('krsDetails'));
    }

    public function create()
    {
        return abort(404);
    }

    public function store(Request $request)
    {
        Grade::updateOrCreate(
            ['krs_detail_id' => $request->krs_detail_id],
            ['numeric_score' => $request->numeric_score, 'letter_grade' => $this->convertToLetter($request->numeric_score)]
        );

        return back()->with('success', 'Nilai tersimpan');
    }

    private function convertToLetter($score)
    {
        if ($score >= 85) {
            return 'A';
        }
        if ($score >= 70) {
            return 'B';
        }
        if ($score >= 55) {
            return 'C';
        }
        if ($score >= 40) {
            return 'D';
        }

        return 'E';
    }

    public function show(Grade $grade)
    {
        return abort(404);
    }

    public function edit(Grade $grade)
    {
        return abort(404);
    }

    public function update(Request $request, Grade $grade)
    {
        return abort(404);
    }

    public function destroy(Grade $grade)
    {
        return abort(404);
    }
}
