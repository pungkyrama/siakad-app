@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Jadwal</h2>

<form action="{{ route('class-schedules.update', $class_schedule->id) }}" method="POST" class="bg-white p-6 shadow rounded-xl max-w-2xl grid grid-cols-2 gap-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 text-sm font-medium">Mata Kuliah</label>
        <select name="course_id" class="w-full border p-2 rounded">
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ $class_schedule->course_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium">Dosen</label>
        <select name="lecturer_id" class="w-full border p-2 rounded">
            @foreach($lecturers as $l)
                <option value="{{ $l->id }}" {{ $class_schedule->lecturer_id == $l->id ? 'selected' : '' }}>{{ $l->user->name ?? 'Unknown' }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium">Ruang</label>
        <select name="room_id" class="w-full border p-2 rounded">
            @foreach($rooms as $r)
                <option value="{{ $r->id }}" {{ $class_schedule->room_id == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium">Tahun Akademik</label>
        <select name="academic_year_id" class="w-full border p-2 rounded">
            @foreach($academicYears as $a)
                <option value="{{ $a->id }}" {{ $class_schedule->academic_year_id == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium">Hari</label>
        <select name="day_of_week" class="w-full border p-2 rounded">
            <option {{ $class_schedule->day_of_week == 'Senin' ? 'selected' : '' }}>Senin</option>
            <option {{ $class_schedule->day_of_week == 'Selasa' ? 'selected' : '' }}>Selasa</option>
            <option {{ $class_schedule->day_of_week == 'Rabu' ? 'selected' : '' }}>Rabu</option>
            <option {{ $class_schedule->day_of_week == 'Kamis' ? 'selected' : '' }}>Kamis</option>
            <option {{ $class_schedule->day_of_week == 'Jumat' ? 'selected' : '' }}>Jumat</option>
        </select>
    </div>
    <div class="flex space-x-2">
        <div class="w-1/2">
            <label class="block mb-1 text-sm font-medium">Mulai</label>
            <input type="time" name="start_time" required value="{{ \Carbon\Carbon::parse($class_schedule->start_time)->format('H:i') }}" class="w-full border p-2 rounded">
        </div>
        <div class="w-1/2">
            <label class="block mb-1 text-sm font-medium">Selesai</label>
            <input type="time" name="end_time" required value="{{ \Carbon\Carbon::parse($class_schedule->end_time)->format('H:i') }}" class="w-full border p-2 rounded">
        </div>
    </div>
    <div class="col-span-2 text-right">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </div>
</form>
@endsection
