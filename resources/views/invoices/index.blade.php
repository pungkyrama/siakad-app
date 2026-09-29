@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold">Tagihan UKT</h2>
    <a href="{{ route('invoices.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg">+ Buat Tagihan</a>
</div>
<div class="bg-white rounded-xl shadow border p-4">
    <table class="w-full">
        <thead class="bg-gray-50 text-left text-sm text-gray-500">
            <tr><th class="p-3">NIM/Nama</th><th class="p-3">Periode</th><th class="p-3">Nominal</th><th class="p-3">Status</th></tr>
        </thead>
        <tbody>
            @foreach($invoices as $inv)
            <tr class="border-t text-sm">
                <td class="p-3">{{ $inv->student->nim ?? '-' }} ({{ $inv->student->user->name ?? '-' }})</td>
                <td class="p-3">{{ $inv->academicYear->name ?? '-' }}</td>
                <td class="p-3 font-bold text-gray-700">Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                <td class="p-3">
                    @if($inv->status == 'Paid') <span class="bg-green-100 text-green-800 px-2 rounded-full">Lunas</span>
                    @else <span class="bg-red-100 text-red-800 px-2 rounded-full">Belum Lunas</span> @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
