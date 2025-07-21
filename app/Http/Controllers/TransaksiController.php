<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;
use App\Models\RepairOrder;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $query = Transaction::query();

    if ($request->has('search')) {
        $search = $request->search;

        $query->whereHas('repairOrder.customer', function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('phone_number', 'like', "%$search%");
        })
        ->orWhere('id', 'like', "%$search%")
        ->orWhere('total_payment', 'like', "%$search%");
    }

    $transactions = $query->with(['repairOrder.customer'])->latest()->get();

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
    // Ambil nilai dari form input (misalnya request biaya layanan dan harga sparepart)
    $repairOrder = RepairOrder::find($request->repair_id);
    
    if (!$repairOrder) {
        return redirect()->back()->with('error', 'Pesanan perbaikan tidak ditemukan.');
    }

    // Hitung total pembayaran
    $totalPayment = $repairOrder->estimated_cost + $repairOrder->sparepart->price;

    // Simpan ke tabel transactions
    Transaction::create([
        'repair_id' => $request->repair_id,
        'total_payment' => $totalPayment,
    ]);

    return redirect()->route('transaksi.detail-transaksi')->with('success', 'Transaksi berhasil ditambahkan.');
}

public function cetakStruk($id)
{
    $transaksi = Transaction::with(['repairOrder.sparepart', 'repairOrder.customer', 'repairOrder.technician'])->findOrFail($id);

    $pdf = PDF::loadView('transaksi.struk', compact('transaksi'));
    return $pdf->stream('struk-transaksi-'.$transaksi->id.'.pdf');
}


    public function show($id)
{
    $transaction = Transaction::with('repairOrder.customer', 'repairOrder.technician', 'repairOrder.sparePart')->findOrFail($id);
    $repairOrder = $transaction->repairOrder;

    return view('transaksi.detail-transaksi', compact('transaction', 'repairOrder'));
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
