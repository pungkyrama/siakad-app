@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Buat Tagihan Baru</h2>
<form action="{{ route('invoices.store') }}" method="POST" class="bg-white p-6 shadow rounded-xl max-w-xl">
    @csrf
    <div class="space-y-4">
        <div><label class="block text-sm font-medium">Mahasiswa</label><select name="student_id" class="w-full border p-2 rounded">@foreach($students as $s) <option value="{{ $s->id }}">{{ $s->nim }} - {{ $s->user->name ?? '' }}</option> @endforeach</select></div>
        <div><label class="block text-sm font-medium">Tahun Akademik</label><select name="academic_year_id" class="w-full border p-2 rounded">@foreach($academicYears as $a) <option value="{{ $a->id }}">{{ $a->name }}</option> @endforeach</select></div>
        <div><label class="block text-sm font-medium">Nominal (Rp)</label><input type="number" name="amount" class="w-full border p-2 rounded" required></div>
    </div>
    <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
