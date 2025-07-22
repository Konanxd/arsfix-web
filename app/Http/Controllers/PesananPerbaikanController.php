<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\SparePart;
use App\Models\RepairOrder;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PesananPerbaikanController extends Controller
{
    public function index()
    {
        // Ambil semua repair order beserta relasi customer, technician, spareparts
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'spareparts'])->get();
        return view('pesanan-perbaikan.index', compact('pesananPerbaikan'));
    }

    public function create()
    {
        $customers = Customers::all();
        $technicians = User::all();
        $spareParts = SparePart::all();

        return view('pesanan-perbaikan.create', compact('customers', 'technicians', 'spareParts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // validasi input
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required',
            'description' => 'required|string',
            'estimated_cost' => 'required|numeric',

            'spare_part_id'   => 'required|array',
            'spare_part_id.*' => 'exists:spare_parts,id',
            'jumlah'         => 'required|array',
            'jumlah.*'       => 'integer|min:1',
        ]);

        // Simpan RepairOrder dulu tanpa sparepart_id dan jumlah
        $repairOrder = RepairOrder::create([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
        ]);
        // Loop sparepart dan attach ke repairOrder (pivot table)
        foreach ($request->spare_part_id as $index => $sparepartId) {
            $jumlah = $request->jumlah[$index];
            $sparepart = SparePart::findOrFail($sparepartId);

            if ($sparepart->stock < $jumlah) {
                return redirect()->back()->with('error', "Stok {$sparepart->name} tidak mencukupi.");
            }

            $repairOrder->spareparts()->attach($sparepartId, ['jumlah' => $jumlah]);

            $sparepart->stock -= $jumlah;
            $sparepart->save();
        }

        // Simpan transaksi
        Transaction::create([
            'repair_id' => $repairOrder->id,
            'total_payment' => $request->estimated_cost,
        ]);

        return redirect()->route('pesananperbaikan.index')->with('success', 'Pesanan perbaikan berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'spareparts'])->findOrFail($id);
        $customers = Customers::all();
        $technicians = User::all();
        $spareParts = SparePart::all();

        return view('pesanan-perbaikan.edit', compact('pesananPerbaikan', 'customers', 'technicians', 'spareParts'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Dalam Proses,Selesai,Batal',
            'description' => 'nullable|string',
            'estimated_cost' => 'required|numeric',

            'spare_part_id' => 'required|array',
            'spare_part_id.*' => 'exists:spare_parts,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        $repairOrder = RepairOrder::with('spareparts')->findOrFail($id);

        // Kembalikan stok sparepart lama dulu supaya stok update dengan benar
        foreach ($repairOrder->spareparts as $sparepart) {
            $sparepart->stock += $sparepart->pivot->jumlah;
            $sparepart->save();
        }

        $sparepartsData = [];
        // Loop semua sparepart baru, cek stok dan kurangi stok sesuai jumlah
        foreach ($request->sparepart_id as $index => $sparepartId) {
            $jumlah = $request->jumlah[$index] ?? 0;
            if ($jumlah < 1) {
                return redirect()->back()->with('error', "Jumlah sparepart harus minimal 1")->withInput();
            }

            $sparepart = SparePart::findOrFail($sparepartId);

            if ($sparepart->stock < $jumlah) {
                return redirect()->back()->with('error', "Stok sparepart {$sparepart->name} tidak mencukupi.")->withInput();
            }

            $sparepart->stock -= $jumlah;
            $sparepart->save();

            $sparepartsData[$sparepartId] = ['jumlah' => $jumlah];
        }

        // Update data repair order utama
        $repairOrder->update([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
        ]);

        // Sync sparepart dengan jumlah baru
        $repairOrder->spareparts()->sync($sparepartsData);

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan perbaikan berhasil diperbarui!');
    }




    public function show($id)
    {
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'spareparts'])->findOrFail($id);
        return view('pesanan-perbaikan.show', compact('pesananPerbaikan'));
    }

    public function destroy($id)
    {
        $pesananPerbaikan = RepairOrder::with('spareparts')->findOrFail($id);

        // Kembalikan stok spareparts yang terkait
        foreach ($pesananPerbaikan->spareparts as $sparepart) {
            $sparepart->stock += $sparepart->pivot->jumlah;
            $sparepart->save();
        }

        // Hapus repair order (pivot akan otomatis terhapus jika relasi sudah pakai onDelete cascade)
        $pesananPerbaikan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan perbaikan berhasil dihapus!');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'spareparts'])
            ->where('description', 'like', '%' . $keyword . '%')
            ->orWhere('id', 'like', '%' . $keyword . '%')
            ->get();

        return view('pesanan-perbaikan.index', compact('pesananPerbaikan'));
    }
}
