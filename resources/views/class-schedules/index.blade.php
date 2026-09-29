@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">Jadwal Kelas</h2>
    <a href="{{ route('class-schedules.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg">+ Tambah</a>
</div>
<div class="bg-white rounded-xl shadow border p-4 overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-50 text-left text-sm text-gray-500">
            <tr><th class="p-3">Mata Kuliah</th><th class="p-3">Dosen</th><th class="p-3">Ruang</th><th class="p-3">Hari/Waktu</th><th class="p-3">Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($schedules as $s)
            <tr class="border-t hover:bg-gray-50 text-sm">
                <td class="p-3">{{ $s->course->name ?? '-' }}</td>
                <td class="p-3">{{ $s->lecturer->user->name ?? '-' }}</td>
                <td class="p-3">{{ $s->room->name ?? '-' }}</td>
                <td class="p-3">{{ $s->day_of_week }}, {{ $s->start_time }} - {{ $s->end_time }}</td>
                <td class="p-3">
                    <a href="{{ route('class-schedules.edit', $s->id) }}" class="text-blue-600 mr-2">Edit</a>
                    <form action="{{ route('class-schedules.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE') <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
