@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">KRS Mahasiswa</h2>
    <a href="{{ route('krs.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg">+ Pengajuan KRS</a>
</div>
<div class="bg-white rounded-xl shadow border p-4">
    <table class="w-full">
        <thead class="bg-gray-50 text-left text-sm text-gray-500">
            <tr><th class="p-3">NIM</th><th class="p-3">Nama</th><th class="p-3">Periode</th><th class="p-3">Status</th></tr>
        </thead>
        <tbody>
            @foreach($krs as $k)
            <tr class="border-t hover:bg-gray-50 text-sm">
                <td class="p-3">{{ $k->student->nim ?? '-' }}</td>
                <td class="p-3">{{ $k->student->user->name ?? '-' }}</td>
                <td class="p-3">{{ $k->academicYear->name ?? '-' }}</td>
                <td class="p-3"><span class="bg-green-100 text-green-800 px-2 rounded-full">{{ $k->status }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
