<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
    {
        return view('pelanggan.index');
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
        // hanya menampilkan view wir.
        return view('pelanggan.edit');
    }
}
