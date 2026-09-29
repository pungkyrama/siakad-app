<?php
namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::with(['user', 'department'])->latest()->get();
        return view('lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('lecturers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nip' => 'required|unique:lecturers',
            'department_id' => 'required'
        ]);

        DB::transaction(function() use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'lecturer'
            ]);

            Lecturer::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'nip' => $request->nip,
                'phone' => $request->phone
            ]);
        });

        return redirect()->route('lecturers.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(Lecturer $lecturer)
    {
        $departments = Department::all();
        return view('lecturers.edit', compact('lecturer', 'departments'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$lecturer->user_id,
            'nip' => 'required|unique:lecturers,nip,'.$lecturer->id,
            'department_id' => 'required'
        ]);

        DB::transaction(function() use ($request, $lecturer) {
            $lecturer->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->filled('password')) {
                $lecturer->user->update(['password' => Hash::make($request->password)]);
            }

            $lecturer->update([
                'department_id' => $request->department_id,
                'nip' => $request->nip,
                'phone' => $request->phone
            ]);
        });

        return redirect()->route('lecturers.index')->with('success', 'Data Dosen berhasil diubah');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->user->delete();
        return redirect()->route('lecturers.index')->with('success', 'Dosen berhasil dihapus');
    }
}
