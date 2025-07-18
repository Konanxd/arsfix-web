<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\RepairOrder;
use App\Models\Customers;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaction::with(['customer', 'repairOrder'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
{
    $repairOrders = RepairOrder::with('customer')->get();
    $repairOrders = RepairOrder::all();
    $customers = Customers::all(); // atau Customer, sesuaikan dengan model kamu
    return view('transaksi.create', compact('repairOrders', 'customers'));
}



    public function store(Request $request)
{
    $request->validate([
        'receipt_id' => 'required',
        'repair_order_id' => 'required|exists:repair_orders,order_id',
        'customers_id' => 'required|exists:customers,customers_id',
        'total_price' => 'required|numeric',
    ]);

    Transaction::create([
        'receipt_id' => $request->receipt_id,
        'repair_order_id' => $request->repair_order_id,
        'customers_id' => $request->customers_id,
        'total_price' => $request->total_price,
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
}


    public function show($id)
    {
        $transaksi = Transaction::with(['customer', 'repairOrder'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $orders = RepairOrder::all();
        $customers = Customers::all();
        return view('transaksi.edit', compact('transaksi', 'orders', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaction::findOrFail($id);

        $request->validate([
            'repair_order_id' => 'required',
            'customers_id' => 'required',
            'total_price' => 'required|numeric',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
