<?php

namespace App\Http\Controllers;

use App\Models\CetakHarga;
use Illuminate\Http\Request;

class StrukCetakHargaController extends Controller
{
    public function index()
    {
        $datas = CetakHarga::orderBy('produk_id', 'ASC')->latest()->get();

        return view('struk-cetak-harga', compact('datas'));
    }
}
