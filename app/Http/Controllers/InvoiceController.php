<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['student.user', 'academicYear'])
            ->whereHas('student', function ($query) {
                $query->where('nim', '!=', '-');
            })
            ->whereHas('student.user', function ($query) {
                $query->where('name', '!=', '-');
            })
            ->latest()
            ->get();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $students = Student::with('user')
            ->where('nim', '!=', '-')
            ->whereHas('user', function ($query) {
                $query->where('name', '!=', '-');
            })
            ->latest()
            ->get();
        $academicYears = AcademicYear::where('is_active', 1)->get();

        return view('invoices.create', compact('students', 'academicYears'));
    }

    public function store(Request $request)
    {
        Invoice::create(['student_id' => $request->student_id, 'academic_year_id' => $request->academic_year_id, 'amount' => $request->amount, 'status' => 'Unpaid']);

        return redirect()->route('invoices.index')->with('success', 'Tagihan dibuat.');
    }

    public function show(Invoice $invoice)
    {
        return abort(404);
    }

    public function edit(Invoice $invoice)
    {
        return abort(404);
    }

    public function update(Request $request, Invoice $invoice)
    {
        return abort(404);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index');
    }
}
