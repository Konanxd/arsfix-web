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
        // Ambil semua repair order beserta customer yang ada
        $repairOrders = RepairOrder::with('customer')->get();
        return view('transaksi.create', compact('repairOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'repair_id' => 'required|exists:repair_orders,id',
        ]);

        $repairOrder = RepairOrder::with('spareparts')->find($request->repair_id);

        if (!$repairOrder) {
            return redirect()->back()->with('error', 'Pesanan perbaikan tidak ditemukan.');
        }

        // Hitung total harga spareparts (jumlah * harga tiap sparepart)
        $totalSparePartCost = 0;
        foreach ($repairOrder->spareparts as $sparepart) {
            $totalSparePartCost += $sparepart->price * $sparepart->pivot->jumlah;
        }

        // Total payment = biaya jasa + total harga sparepart
        $totalPayment = $repairOrder->estimated_cost + $totalSparePartCost;

        Transaction::create([
            'repair_id' => $repairOrder->id,
            'spare_part_cost' => $totalSparePartCost,
            'service_fee' => $repairOrder->estimated_cost,
            'total_payment' => $totalPayment,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaction::with(['repairOrder.spareparts', 'repairOrder.customer', 'repairOrder.technician'])->findOrFail($id);

        $pdf = PDF::loadView('transaksi.struk', compact('transaksi'));
        return $pdf->stream('struk-transaksi-' . $transaksi->id . '.pdf');
    }

    public function show($id)
    {
        $transaction = Transaction::with(['repairOrder.customer', 'repairOrder.technician', 'repairOrder.spareparts'])->findOrFail($id);
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
        $transaction = Transaction::with(['repairOrder.customer', 'repairOrder.technician', 'repairOrder.spareparts'])
            ->findOrFail($id);

        // Ambil repair order
        $repairOrder = $transaction->repairOrder;

        // Loop spareparts dan ambil data dari pivot
        foreach ($repairOrder->spareparts as $sparepart) {
            echo "Nama Sparepart: " . $sparepart->name . "<br>";
            echo "Harga: Rp " . number_format($sparepart->price, 0, ',', '.') . "<br>";
            echo "Jumlah di pivot: " . $sparepart->pivot->jumlah . "<br><br>";
        }

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
