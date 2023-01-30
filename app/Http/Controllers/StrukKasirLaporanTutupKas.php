<?php

namespace App\Http\Controllers;

use App\Models\KasirReport;
use Illuminate\Http\Request;

class StrukKasirLaporanTutupKas extends Controller
{
    public function index($id)
    {
        $data = KasirReport::find($id);
        // dd($data);
        return view('struk-kasir-laporan-tutup-kas', compact('data'));
    }
}
