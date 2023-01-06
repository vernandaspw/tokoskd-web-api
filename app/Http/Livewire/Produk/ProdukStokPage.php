<?php

namespace App\Http\Livewire\Produk;

use App\Models\ProdukItem;
use Livewire\Component;

class ProdukStokPage extends Component
{
    public $tambahPage = false, $editPage = false;

    public $produkItems = [];

    public $produkNama;

    public $takeProdukitem = 20;

    public function render()
    {
        $produk = ProdukItem::with('produk')->latest()->take($this->takeProdukitem);
        if ($this->produkNama) {
            $produk->whereRelation('produk','nama', 'like', '%' . $this->produkNama . '%');
        }
        $this->produkItems = $produk->get();
        return view('livewire.produk.produk-stok-page')->extends('layouts.app')->section('content');
    }
}
