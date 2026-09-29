@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Penilaian Mahasiswa</h2>
<div class="bg-white rounded-xl shadow border p-4">
    <table class="w-full">
        <thead class="bg-gray-50 text-left text-sm text-gray-500">
            <tr><th class="p-3">Mata Kuliah</th><th class="p-3">NIM/Nama</th><th class="p-3">Nilai Angka</th><th class="p-3">Huruf</th><th class="p-3">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($krsDetails as $kd)
            <tr class="border-t text-sm">
                <td class="p-3">{{ $kd->classSchedule->course->name ?? '-' }}</td>
                <td class="p-3">{{ $kd->krs->student->nim ?? '-' }} ({{ $kd->krs->student->user->name ?? '-' }})</td>
                <td class="p-3 font-bold">{{ $kd->grade->numeric_score ?? '-' }}</td>
                <td class="p-3 font-bold text-blue-600">{{ $kd->grade->letter_grade ?? '-' }}</td>
                <td class="p-3">
                    <form action="{{ route('grades.store') }}" method="POST" class="flex space-x-2">
                        @csrf
                        <input type="hidden" name="krs_detail_id" value="{{ $kd->id }}">
                        <input type="number" name="numeric_score" max="100" min="0" class="border rounded p-1 w-20" placeholder="0-100" required>
                        <button class="bg-green-600 text-white px-2 py-1 rounded">Simpan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
