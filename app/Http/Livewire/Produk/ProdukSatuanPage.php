<?php

namespace App\Http\Livewire\Produk;

use App\Models\Produk;
use Livewire\Component;

class ProdukSatuanPage extends Component
{
    public $produks = [];

    public $tambahPage = false, $editPage = false;

    public $takeProduk = 15;



    public function render()
    {
        $this->produks = Produk::with('produk_item', 'merek', 'catalog', 'kategori', 'rak', 'supplier')->latest()->take($this->takeProduk)->get();
    //    dd($this->produks);
        return view('livewire.produk.produk-satuan-page')->extends('layouts.app')->section('content');
    }

    public function takeProduk()
    {
        $this->take += 15;
    }

    public function hapus($id)
    {
        $data= Produk::find($id)->delete();

        $this->emit('success', ['pesan' => 'Berhasil hapus item']);
    }

}
