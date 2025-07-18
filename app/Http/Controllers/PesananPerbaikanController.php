<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\SparePart;
use App\Models\Technician;
use App\Models\RepairOrder;
use App\Models\User;
use Illuminate\Http\Request;

class PesananPerbaikanController extends Controller
{
    /**
     * Menampilkan daftar pesanan perbaikan.
     */
    public function index()
    {
        // Mengambil semua data pesanan perbaikan dari database
        // Menggunakan nama relasi yang sesuai dengan model dan foreign key di migration
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])->get();

        // Mengirim data pesanan perbaikan ke view 'pesanan-perbaikan.index'
        return view('pesanan-perbaikan.index', compact('pesananPerbaikan'));
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     */
    public function create()
    {
        // Mengambil data customer, technician, dan spare part untuk dropdown di form
        $customers = Customers::all();
        $technicians = User::all();
        $spareParts = SparePart::all();

        // Menampilkan view form penambahan pesanan perbaikan
        return view('pesanan-perbaikan.create', compact('customers', 'technicians', 'spareParts'));
    }
    
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form sesuai dengan skema migration
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Pastikan customer ada
            'technician_id' => 'required|exists:technicians,id', // Pastikan technician ada
            'sparepart_id' => 'required|exists:spare_parts,id', // Pastikan spare part ada
            'order_date' => 'required|date',
            'status' => 'required|in:Dalam Proses,Selesai,Batal', // Sesuai dengan enum di migration
            'description' => 'nullable|string', // longText, jadi tidak perlu max
            'estimated_cost' => 'required|integer', // integer
        ]);

        // Membuat instance PesananPerbaikan baru dan mengisi datanya
        // ID akan otomatis di-generate oleh database karena $table->id()
        RepairOrder::create([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'sparepart_id' => $request->sparepart_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
            // 'tgl_selesai' dihapus karena tidak ada di migration yang baru
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        // Sesuai dengan P06 (pesan berhasil) dan kembali ke T08
        return redirect()->route('pesanan-perbaikan.index')->with('success', 'Data pesanan perbaikan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit pesanan perbaikan berdasarkan ID.
     */
    public function edit($id)
    {
        // Mencari pesanan perbaikan yang akan diedit
        $pesananPerbaikan = RepairOrder::findOrFail($id);
        // Mengambil data customer, technician, dan spare part untuk dropdown di form
        $customers = Customers::all();
        $technicians = User::all();
        $spareParts = SparePart::all();

        // Menampilkan view form pengubahan pesanan perbaikan dengan data yang ada
        return view('pesanan-perbaikan.edit', compact('pesananPerbaikan', 'customers', 'technicians', 'spareParts'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk dari form sesuai dengan skema migration
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'required|exists:technicians,id',
            'sparepart_id' => 'required|exists:spare_parts,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Dalam Proses,Selesai,Batal',
            'description' => 'nullable|string',
            'estimated_cost' => 'required|integer',
        ]);

        // Mencari pesanan perbaikan yang akan diperbarui
        $pesananPerbaikan = RepairOrder::findOrFail($id);

        // Memperbarui data pesanan perbaikan
        $pesananPerbaikan->update([
            'customer_id' => $request->customer_id,
            'technician_id' => $request->technician_id,
            'sparepart_id' => $request->sparepart_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
            // 'tgl_selesai' dihapus karena tidak ada di migration yang baru
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        // Sesuai dengan P08 (pesan berhasil) dan kembali ke T08
        return redirect()->route('pesanan-perbaikan.index')->with('success', 'Data pesanan perbaikan berhasil diperbarui!');
    }

    public function show($id)
    {
        // Mencari pesanan perbaikan berdasarkan ID, dengan relasi customer, technician, dan spare part
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])->findOrFail($id);

        // Mengirim data pesanan perbaikan ke view 'pesanan-perbaikan.show'
        return view('pesanan-perbaikan.show', compact('pesananPerbaikan'));
    }

    public function destroy($id)
    {
        // Mencari pesanan perbaikan yang akan dihapus
        $pesananPerbaikan = RepairOrder::findOrFail($id);

        // Menghapus pesanan perbaikan
        $pesananPerbaikan->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        // Sesuai dengan P03 (pesan konfirmasi hapus)
        return redirect()->route('pesanan-perbaikan.index')->with('success', 'Data pesanan perbaikan berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Melakukan pencarian berdasarkan description atau ID pesanan
        $pesananPerbaikan = RepairOrder::with(['customer', 'technician', 'sparePart'])
                                ->where('description', 'like', '%' . $keyword . '%')
                                ->orWhere('id', 'like', '%' . $keyword . '%') // Menggunakan 'id' karena migration menggunakan $table->id()
                                ->get();

        // Mengirim hasil pencarian ke view yang sama dengan index atau view khusus pencarian
        return view('pesanan-perbaikan.index', compact('pesananPerbaikan'));
    }
}
