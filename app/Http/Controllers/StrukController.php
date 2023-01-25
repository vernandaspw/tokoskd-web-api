<?php

namespace App\Http\Controllers;

use App\Models\Penjualan\Penjualan;
use Illuminate\Http\Request;

class StrukController extends Controller
{
    public function index($id)
    {
        $data = Penjualan::where('no_penjualan', $id)->first();
        return view('struk', compact('data'));
    }
}
