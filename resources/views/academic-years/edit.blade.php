@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Edit Tahun Akademik</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <form action="{{ route('academic-years.update', $academicYear->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Periode (Cth: 2026/2027)</label>
                <input type="text" name="name" value="{{ $academicYear->name }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                <select name="semester" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" required>
                    <option value="Ganjil" {{ $academicYear->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ $academicYear->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Aktif</label>
                <select name="is_active" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2" required>
                    <option value="1" {{ $academicYear->is_active == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $academicYear->is_active == '0' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('academic-years.index') }}" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-50 mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
