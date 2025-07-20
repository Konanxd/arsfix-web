<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\RepairOrder;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
{
    $transactions = Transaction::with('repairOrder.customer')->get();
    return view('transaksi.index', compact('transactions'));
}


    public function create()
    {
        // Ambil semua pesanan perbaikan yang memiliki customer
        $repairOrders = RepairOrder::with('customer')->get();
        return view('transaksi.create', compact('repairOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:transactions,id',
            'repair_id' => 'required|exists:repair_orders,id',
            'total_payment' => 'required|numeric',
        ]);

        Transaction::create([
            'id' => $request->id,
            'repair_id' => $request->repair_id,
            'total_payment' => $request->total_payment,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show($id)
    {
        // Pastikan nama relasi benar (repairOrder.customer)
        $transaksi = Transaction::with('repairOrder.customer')->findOrFail($id);
        return view('transaksi.detail-transaksi', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $repairOrders = RepairOrder::with('customer')->get();
        return view('transaksi.edit', compact('transaksi', 'repairOrders'));
    }

    public function detail($id)
{
    $transaction = Transaction::with(['repairOrder.customer', 'repairOrder.technician'])
        ->findOrFail($id);

    return view('transaksi.detail', compact('transaction'));
}


    public function update(Request $request, $id)
    {
        $transaksi = Transaction::findOrFail($id);

        $request->validate([
            'repair_id' => 'required|exists:repair_orders,id',
            'total_payment' => 'required|numeric',
        ]);

        $transaksi->update([
            'repair_id' => $request->repair_id,
            'total_payment' => $request->total_payment,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
