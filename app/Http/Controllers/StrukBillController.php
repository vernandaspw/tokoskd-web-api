<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class StrukBillController extends Controller
{
    public function index($id)
    {
        $data = Bill::where('no_bill', $id)->first();
        // dd($data);
        return view('struk-bill', compact('data'));
    }
}
