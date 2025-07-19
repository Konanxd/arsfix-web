<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\SparePart;
use App\Models\RepairOrder;
use App\Models\User;
use Illuminate\Http\Request;

class PesananPerbaikanController extends Controller
{
    public function index()
    {
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])->get();
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
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'required|exists:users,id',
            'sparepart_id' => 'required|exists:spare_parts,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Dalam Proses,Selesai,Batal',
            'description' => 'required|string',
            'estimated_cost' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
        ]);

        $sparePart = SparePart::findOrFail($request->sparepart_id);

        if ($sparePart->stock < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok suku cadang tidak mencukupi.'])->withInput();
        }

        RepairOrder::create([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'sparepart_id' => $request->sparepart_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
            'jumlah' => $request->jumlah,
        ]);

        // Kurangi stok sparepart
        $sparePart->stock -= $request->jumlah;
        $sparePart->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat');
    }


        public function edit($id)
        {
            $pesananPerbaikan = RepairOrder::findOrFail($id);
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
            'sparepart_id' => 'required|exists:spare_parts,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Dalam Proses,Selesai,Batal',
            'description' => 'required|string',
            'estimated_cost' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
        ]);

        $pesananPerbaikan = RepairOrder::findOrFail($id);

        // Ambil data sparepart lama dan baru
        $sparePartLama = SparePart::findOrFail($pesananPerbaikan->sparepart_id);
        $sparePartBaru = SparePart::findOrFail($request->sparepart_id);

        // Kembalikan stok suku cadang lama
        $sparePartLama->stock += $pesananPerbaikan->jumlah;
        $sparePartLama->save();

        // Periksa stok suku cadang baru
        if ($sparePartBaru->stock < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok suku cadang tidak mencukupi.'])->withInput();
        }

        // Update pesanan
        $pesananPerbaikan->update([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'sparepart_id' => $request->sparepart_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
            'jumlah' => $request->jumlah,
        ]);

        // Kurangi stok suku cadang baru
        $sparePartBaru->stock -= $request->jumlah;
        $sparePartBaru->save();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan perbaikan berhasil diperbarui!');
    }


    public function show($id)
    {
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])->findOrFail($id);
        return view('pesanan-perbaikan.show', compact('pesananPerbaikan'));
    }



    public function destroy($id)
    {
        $pesananPerbaikan = RepairOrder::findOrFail($id);

        // Restore stok sparepart saat hapus pesanan
        $sparePart = SparePart::findOrFail($pesananPerbaikan->sparepart_id);
        $sparePart->stock += $pesananPerbaikan->jumlah;
        $sparePart->save();

        $pesananPerbaikan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan perbaikan berhasil dihapus!');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])
            ->where('description', 'like', '%' . $keyword . '%')
            ->orWhere('id', 'like', '%' . $keyword . '%')
            ->get();

        return view('pesanan-perbaikan.index', compact('pesananPerbaikan'));
    }
}
