<?php

namespace App\Http\Controllers;

use App\Models\Customers; // <-- Panggil model Customers Anda
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customers_id' => 'required|string|unique:customers',
            'name_customers' => 'required|string|max:50',
            'phone_number' => 'nullable|string|max:15',
            'handphone' => 'nullable|string|max:15',
        ]);

        Customers::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Data customer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customers::findOrFail($id);

        $request->validate([
            'name_customers' => 'required|string|max:50',
            'phone_number' => 'nullable|string|max:15',
            'handphone' => 'nullable|string|max:15',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Data customer berhasil dihapus.');
    }
}