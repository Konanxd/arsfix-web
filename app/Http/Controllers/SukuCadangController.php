<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SukuCadangController extends Controller
{
    public function index()
    {
        return view('suku-cadang.index');
    }

     public function create()
    {
        return view('suku-cadang.create');
    }

    public function edit($id)
    {
        return view('suku-cadang.edit');
    }
}
