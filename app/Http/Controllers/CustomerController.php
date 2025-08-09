<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
            ->get();

        return view('pelanggan.index', compact('customers', 'search'));
    }


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
        $customer = Customers::findOrFail($id);
        return view('pelanggan.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customers::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'nullable|string|max:13',

        ]);

        $customer->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data customer berhasil dihapus.');
    }
}
