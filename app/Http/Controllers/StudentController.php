<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'department'])->latest()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('students.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nim' => 'required|unique:students',
            'department_id' => 'required',
            'address' => 'required'
        ]);

        DB::transaction(function() use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student'
            ]);

            Student::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'nim' => $request->nim,
                'address' => $request->address
            ]);
        });

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        return view('students.edit', compact('student', 'departments'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$student->user_id,
            'nim' => 'required|unique:students,nim,'.$student->id,
            'department_id' => 'required',
            'address' => 'required'
        ]);

        DB::transaction(function() use ($request, $student) {
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->filled('password')) {
                $student->user->update(['password' => Hash::make($request->password)]);
            }

            $student->update([
                'department_id' => $request->department_id,
                'nim' => $request->nim,
                'address' => $request->address
            ]);
        });

        return redirect()->route('students.index')->with('success', 'Data Mahasiswa berhasil diubah');
    }

    public function destroy(Student $student)
    {
        $student->user->delete(); 
        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
