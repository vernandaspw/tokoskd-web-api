<?php

namespace App\Http\Livewire\Produk;

use Livewire\Component;

class ProdukStokPage extends Component
{
    public $tambahPage = false, $editPage = false;

    public $produkItems = [];

    public function render()
    {
        return view('livewire.produk.produk-stok-page')->extends('layouts.app')->section('content');
    }
}
