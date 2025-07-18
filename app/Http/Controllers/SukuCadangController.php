<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;

class SukuCadangController extends Controller
{
    public function index(Request $request)
    {
        $query = SparePart::query();

        // Implementasi pencarian (Mencari Data Suku Cadang)
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('id', 'like', '%' . $searchTerm . '%');
        }

        $sukuCadang = $query->paginate(10); // Sesuaikan jumlah item per halaman

        // Kirim data ke view
        return view('suku-cadang.index', compact('sukuCadang'));
    }

    

     public function create()
    {
        return view('suku-cadang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50', // Sesuaikan dengan 'name' dan panjang 50
            'price' => 'required|numeric|min:0', // Sesuaikan dengan 'price'
            'stock' => 'required|integer|min:0', // Sesuaikan dengan 'stock'
        ]);

        SparePart::create($request->all());

        return redirect()->route('suku-cadang.index')->with('success', 'Data suku cadang berhasil ditambahkan.');
    }

    public function show(SparePart $sukuCadang)
    {
        return view('suku-cadang.show', compact('sukuCadang'));
    }

    public function edit($id)
    {
        $sukuCadang = SparePart::findOrFail($id); // Ambil data berdasarkan id
        return view('suku-cadang.edit', compact('sukuCadang')); // Kirim data ke view
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $sukuCadang = SparePart::findOrFail($id);
        $sukuCadang->update($request->all());

        return redirect()->route('suku-cadang.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $sukuCadang = SparePart::findOrFail($id);
        $sukuCadang->delete();

        return redirect()->route('suku-cadang.index')->with('success', 'Data suku cadang berhasil dihapus.');
    }


}
