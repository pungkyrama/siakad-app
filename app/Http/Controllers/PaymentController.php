<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice.student.user')
            ->whereHas('invoice.student.user', function ($query) {
                $query->where('name', '!=', '-');
            })
            ->latest()
            ->get();
        $invoices = Invoice::where('status', 'Unpaid')->with('student.user')->get();

        return view('payments.index', compact('payments', 'invoices'));
    }

    public function create()
    {
        return abort(404);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            Payment::create($request->all());
            $inv = Invoice::find($request->invoice_id);
            $total = Payment::where('invoice_id', $inv->id)->sum('amount');
            if ($total >= $inv->amount) {
                $inv->update(['status' => 'Paid']);
            }
        });

        return redirect()->route('payments.index')->with('success', 'Pembayaran diterima.');
    }

    public function show(Payment $payment)
    {
        return abort(404);
    }

    public function edit(Payment $payment)
    {
        return abort(404);
    }

    public function update(Request $request, Payment $payment)
    {
        return abort(404);
    }

    public function destroy(Payment $payment)
    {
        return abort(404);
    }
}
