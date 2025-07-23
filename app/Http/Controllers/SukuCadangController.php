<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;

class SukuCadangController extends Controller
{
    public function index(Request $request)
    {
        $query = SparePart::query();

        if ($request->has('search')) {
            $search = $request->search;

            $query->where('name', 'like', "%$search%");
        }

        $sukuCadang = $query->latest()->get();
        $sukuCadang = $query->orderBy('id', 'desc')->get(); // Terbaru dulu

        return view('suku-cadang.index', compact('sukuCadang'));
    }

    

     public function create()
    {
        return view('suku-cadang.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:50',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['name', 'price', 'stock']);

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $filename);
        $data['image'] = 'uploads/' . $filename;
    }

    SparePart::create($data);

    return redirect()->route('suku-cadang.index')->with('success', 'Data suku cadang berhasil ditambahkan.');
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
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $sukuCadang = SparePart::findOrFail($id);
    $data = $request->only(['name', 'price', 'stock']);

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $filename);
        $data['image'] = 'uploads/' . $filename;
    }

    $sukuCadang->update($data);

    return redirect()->route('suku-cadang.index')->with('success', 'Data berhasil diperbarui.');
}





    public function destroy($id)
    {
        $sukuCadang = SparePart::findOrFail($id);
        $sukuCadang->delete();

        return redirect()->route('suku-cadang.index')->with('success', 'Data suku cadang berhasil dihapus.');
    }


}
