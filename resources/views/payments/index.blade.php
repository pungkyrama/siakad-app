@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2">
        <h2 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h2>
        <div class="bg-white rounded-xl shadow border p-4">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-gray-500">
                    <tr><th class="p-3">Tanggal</th><th class="p-3">Mahasiswa</th><th class="p-3">Nominal</th><th class="p-3">Metode</th></tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->payment_date }}</td>
                        <td class="p-3">{{ $p->invoice->student->user->name ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $p->payment_method }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div>
        <h2 class="text-2xl font-bold mb-4">Input Pembayaran</h2>
        <form action="{{ route('payments.store') }}" method="POST" class="bg-white p-6 shadow rounded-xl">
            @csrf
            <div class="space-y-4">
                <div><label class="block text-sm font-medium">Tagihan (Unpaid)</label>
                    <select name="invoice_id" class="w-full border p-2 rounded">
                        @foreach($invoices as $i) <option value="{{ $i->id }}">{{ $i->student->user->name ?? '' }} (Rp {{ number_format($i->amount, 0, ',', '.') }})</option> @endforeach
                    </select>
                </div>
                <div><label class="block text-sm font-medium">Nominal (Rp)</label><input type="number" name="amount" class="w-full border p-2 rounded" required></div>
                <div><label class="block text-sm font-medium">Metode</label><select name="payment_method" class="w-full border p-2 rounded"><option>Transfer Bank</option><option>Cash</option></select></div>
                <div><label class="block text-sm font-medium">Tanggal</label><input type="date" name="payment_date" class="w-full border p-2 rounded" required value="{{ date('Y-m-d') }}"></div>
            </div>
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded">Proses Bayar</button>
        </form>
    </div>
</div>
@endsection
