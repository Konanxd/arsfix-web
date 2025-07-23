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
    public function index(Request $request)
    {
        // Mulai query dengan filter status 'Dalam Proses'
        $query = RepairOrder::where('status', 'Dalam Proses');

        // Jika ada pencarian, terapkan pada query yang sudah difilter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhereHas('customer', function($subQ) use ($search) {
                    $subQ->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Ambil data yang sudah difilter
        $pesananPerbaikan = $query->with(['customer', 'technician'])->latest()->get();

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
            // 'status' => 'required', // Hapus validasi status
            'description' => 'required|string',
            'estimated_cost' => 'required|numeric',
            'spare_part_id'   => 'required|array',
            'spare_part_id.*' => 'exists:spare_parts,id',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'integer|min:1',
        ]);

        // Simpan RepairOrder
        $repairOrder = RepairOrder::create([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'order_date' => $request->order_date,
            'status' => 'Dalam Proses', // Status di-set secara otomatis
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
        ]);

        // Loop sparepart dan attach ke repairOrder (pivot table)
        foreach ($request->spare_part_id as $index => $sparepartId) {
            $jumlah = $request->jumlah[$index];
            $sparepart = SparePart::findOrFail($sparepartId);

            if ($sparepart->stock < $jumlah) {
                // Hapus pesanan yang baru dibuat karena transaksi gagal
                $repairOrder->delete(); 
                return redirect()->back()->with('error', "Stok {$sparepart->name} tidak mencukupi.")->withInput();
            }

            $repairOrder->spareparts()->attach($sparepartId, ['jumlah' => $jumlah]);

            // Kurangi stok
            $sparepart->stock -= $jumlah;
            $sparepart->save();
        }

        // Redirect ke daftar pesanan perbaikan (bukan pesananperbaikan.index)
        return redirect()->route('pesanan.index')->with('success', 'Pesanan perbaikan berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'spareparts'])->findOrFail($id);
        $customers = Customers::all();
        $technicians = User::all();
        $spareParts = SparePart::all();

        // Ambil spareparts dengan pivot 'jumlah' dan urut berdasarkan waktu pivot dibuat (terbaru dulu)
        $selectedSpareparts = $pesananPerbaikan->spareparts()
        ->withPivot('jumlah', 'created_at')
        ->orderBy('pivot_created_at', 'desc')
        ->get();

        return view('pesanan-perbaikan.edit', [
        'pesananPerbaikan' => $pesananPerbaikan,
        'spareParts' => SparePart::all(),
        'selectedSpareparts' => $selectedSpareparts,
        ]);

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
        if ($repairOrder->spareparts && $repairOrder->spareparts->count() > 0) {
            foreach ($repairOrder->spareparts as $sparepart) {
                $sparepart->stock += $sparepart->pivot->jumlah ?? 0;
                $sparepart->save();
            }
        }

        $sparepartsData = [];
        // Loop semua sparepart baru, cek stok dan kurangi stok sesuai jumlah
        foreach ($request->spare_part_id as $index => $sparepartId) {
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

    public function cancel(Request $request, $id)
    {
        $repairOrder = RepairOrder::with('spareparts')->findOrFail($id);

        // 1. Cek apakah pesanan bisa dibatalkan
        if (in_array($repairOrder->status, ['Selesai', 'Batal'])) {
            return redirect()->back()->with('error', 'Pesanan yang sudah selesai atau dibatalkan tidak dapat diubah.');
        }

        // 2. Kembalikan stok sparepart ke sistem
        foreach ($repairOrder->spareparts as $sparepart) {
            $sparepart->stock += $sparepart->pivot->jumlah;
            $sparepart->save();
        }

        // 3. Ubah status pesanan
        $repairOrder->status = 'Batal';
        $repairOrder->save();
        
        // 4. Update transaksi yang sudah ada (jika ada) menjadi Rp 0
        // Asumsi: satu repair order hanya punya satu transaksi
        $transaction = Transaction::where('repair_id', $repairOrder->id)->first();
        if ($transaction) {
            $transaction->total_payment = 0;
            $transaction->save();
        } else {
             // Jika belum ada transaksi, buat baru dengan status batal
             Transaction::create([
                'repair_id' => $repairOrder->id,
                'total_payment' => 0,
            ]);
        }
        
        // 5. Redirect ke halaman transaksi
        return redirect()->route('transaksi.index')->with('success', 'Pesanan #' . $repairOrder->id . ' telah dibatalkan.');
    }
}
