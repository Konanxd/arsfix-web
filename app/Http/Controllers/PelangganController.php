<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    // public function index()
    // {
    //     $customers = Customers::all();
    //     return view('pelanggan.index', compact('customers'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customers::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone_number', 'like', '%' . $search . '%');
                });
            })
            ->latest() // Mengurutkan dari data yang terbaru
            ->paginate(5) // Membatasi 5 data per halaman
            ->withQueryString(); // Mempertahankan keyword pencarian saat pindah halaman

        return view('pelanggan.index', compact('customers', 'search'));
    }

    /**
     * Menampilkan form untuk membuat pelanggan baru.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'nullable|string',
        ]);

        Customers::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data customer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $customer = Customers::findOrFail($id); // ambil data berdasarkan ID
        return view('pelanggan.edit', compact('customer')); // kirim ke view
    }

    
    
    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
