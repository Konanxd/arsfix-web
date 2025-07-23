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

        $repairOrder = RepairOrder::with('spareparts')->findOrFail($request->repair_id);

        if ($repairOrder->status !== 'Dalam Proses') {
            return redirect()->back()->with('error', 'Hanya pesanan yang sedang diproses yang bisa diselesaikan.');
        }

        // 1. Hitung total biaya
        $totalSparePartCost = $repairOrder->spareparts->reduce(function ($carry, $item) {
            return $carry + ($item->price * $item->pivot->jumlah);
        }, 0);
        $totalPayment = $repairOrder->estimated_cost + $totalSparePartCost;

        // 2. Gunakan updateOrCreate untuk menghindari error duplikat
        Transaction::updateOrCreate(
            ['repair_id' => $repairOrder->id], // Kunci untuk mencari
            [                                   // Data untuk di-update atau dibuat
                'total_payment' => $totalPayment,
                // Anda bisa tambahkan field lain di sini jika perlu
            ]
        );

        // 3. Ubah status pesanan menjadi 'Selesai'
        $repairOrder->status = 'Selesai';
        $repairOrder->save();

        return redirect()->route('transaksi.index')->with('success', 'Pesanan telah diselesaikan dan transaksi berhasil dibuat.');
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

        return view('transaksi.show', compact('transaction', 'repairOrder'));
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
