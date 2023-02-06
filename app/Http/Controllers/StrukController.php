<?php

namespace App\Http\Controllers;

use App\Models\Penjualan\Penjualan;
use Illuminate\Http\Request;

class StrukController extends Controller
{
    public function index($id)
    {
        // $data = Penjualan::where('id', $id)->first();
        $data = Penjualan::find($id);
        // dd($data);
        return view('struk', compact('data'));
    }
}
