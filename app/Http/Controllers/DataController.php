<?php

namespace App\Http\Controllers;

class DataController extends Controller
{

    public function index()
    {
        $data = auth()->user()->data; // Mengambil data yang terkait dengan pengguna yang masuk
        return view('data.index', compact('data'));

    }
}
