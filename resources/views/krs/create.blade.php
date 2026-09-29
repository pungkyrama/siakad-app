@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Pengajuan KRS Baru</h2>
<form action="{{ route('krs.store') }}" method="POST" class="bg-white p-6 shadow rounded-xl">
    @csrf
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div><label class="block text-sm font-medium">Mahasiswa</label><select name="student_id" class="w-full border p-2 rounded">@foreach($students as $s) <option value="{{ $s->id }}">{{ $s->nim }} - {{ $s->user->name ?? '' }}</option> @endforeach</select></div>
        <div><label class="block text-sm font-medium">Tahun Akademik</label><select name="academic_year_id" class="w-full border p-2 rounded">@foreach($academicYears as $a) <option value="{{ $a->id }}">{{ $a->name }}</option> @endforeach</select></div>
    </div>
    <h3 class="font-semibold mb-2">Pilih Mata Kuliah</h3>
    <div class="space-y-2 border p-4 rounded bg-gray-50 max-h-60 overflow-y-auto">
        @foreach($schedules as $s)
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="schedules[]" value="{{ $s->id }}" class="rounded text-blue-600">
            <span>{{ $s->course->code ?? '-' }} - {{ $s->course->name ?? '-' }} ({{ $s->course->credits ?? '-' }} SKS) | {{ $s->course->department->name ?? '-' }}</span>
        </label>
        @endforeach
    </div>
    <div class="mt-4 text-right"><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan KRS</button></div>
</form>
@endsection
