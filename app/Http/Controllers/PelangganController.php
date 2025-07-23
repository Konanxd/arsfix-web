<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
{
    $customers = Customers::all();
    return view('pelanggan.index', compact('customers'));
}

    /**
     * Menampilkan form untuk membuat pelanggan baru.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    public function edit($id)
{
    $customer = Customers::findOrFail($id); // ambil data berdasarkan ID
    return view('pelanggan.edit', compact('customer')); // kirim ke view
}
}
