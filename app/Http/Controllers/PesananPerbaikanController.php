<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananPerbaikanController extends Controller
{
    /**
     * Menampilkan daftar pesanan perbaikan.
     */
    public function index()
    {
        return view('pesanan-perbaikan.index');
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     */
    public function create()
    {
        return view('pesanan-perbaikan.create');
    }

    /**
     * Menampilkan form untuk mengedit pesanan perbaikan berdasarkan ID.
     */
    public function edit($id)
    {
        return view('pesanan-perbaikan.edit');
    }
}
