@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">Mahasiswa</h2>
    <a href="{{ route('students.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg">+ Tambah</a>
</div>
<div class="bg-white rounded-xl shadow border p-4">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 text-left text-sm uppercase text-gray-500">
                <th class="p-3">No</th><th class="p-3">NIM</th><th class="p-3">Nama</th><th class="p-3">Program Studi</th><th class="p-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $s)
            <tr class="border-t hover:bg-gray-50 text-sm">
                <td class="p-3">{{ $loop->iteration }}</td>
                <td class="p-3">{{ $s->nim }}</td>
                <td class="p-3">{{ $s->user->name ?? '-' }}</td>
                <td class="p-3">{{ $s->department->name ?? '-' }}</td>
                <td class="p-3 text-right">
                    <a href="{{ route('students.edit', $s->id) }}" class="text-blue-600 mr-2">Edit</a>
                    <form action="{{ route('students.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE') <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
