@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Tambah Jadwal</h2>
<form action="{{ route('class-schedules.store') }}" method="POST" class="bg-white p-6 shadow rounded-xl max-w-2xl grid grid-cols-2 gap-4">
    @csrf
    <div><label class="block mb-1 text-sm font-medium">Mata Kuliah</label><select name="course_id" class="w-full border p-2 rounded">@foreach($courses as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach</select></div>
    <div><label class="block mb-1 text-sm font-medium">Dosen</label><select name="lecturer_id" class="w-full border p-2 rounded">@foreach($lecturers as $l) <option value="{{ $l->id }}">{{ $l->user->name ?? 'Unknown' }}</option> @endforeach</select></div>
    <div><label class="block mb-1 text-sm font-medium">Ruang</label><select name="room_id" class="w-full border p-2 rounded">@foreach($rooms as $r) <option value="{{ $r->id }}">{{ $r->name }}</option> @endforeach</select></div>
    <div><label class="block mb-1 text-sm font-medium">Tahun Akademik</label><select name="academic_year_id" class="w-full border p-2 rounded">@foreach($academicYears as $a) <option value="{{ $a->id }}">{{ $a->name }}</option> @endforeach</select></div>
    <div><label class="block mb-1 text-sm font-medium">Hari</label><select name="day_of_week" class="w-full border p-2 rounded"><option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option></select></div>
    <div class="flex space-x-2">
        <div class="w-1/2"><label class="block mb-1 text-sm font-medium">Mulai</label><input type="time" name="start_time" required class="w-full border p-2 rounded"></div>
        <div class="w-1/2"><label class="block mb-1 text-sm font-medium">Selesai</label><input type="time" name="end_time" required class="w-full border p-2 rounded"></div>
    </div>
    <div class="col-span-2 text-right"><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button></div>
</form>
@endsection
