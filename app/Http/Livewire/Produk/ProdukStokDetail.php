<?php

namespace App\Http\Livewire\Produk;

use App\Models\ProdukItem;
use App\Models\StokTransaksi;
use Livewire\Component;

class ProdukStokDetail extends Component
{
    public $ID;



    public function mount($id)
    {
        $this->ID = $id;
    }
    public function render()
    {
        $this->produk = ProdukItem::find($this->ID);

        $this->stoktransaksi = StokTransaksi::where('produk_item_id', $this->ID)->latest()->get();
        return view('livewire.produk.produk-stok-detail')->extends('layouts.app')->section('content');
    }


}
