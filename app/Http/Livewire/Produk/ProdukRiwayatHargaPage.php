<?php

namespace App\Http\Livewire\Produk;

use App\Models\RiwayatHarga;
use Livewire\Component;

class ProdukRiwayatHargaPage extends Component
{
    public $riwayats = [];
    public $take = 20;

    protected $listeners = [
        'take-data' => 'take'
    ];

    public function take()
    {
        $this->take += 15;
    }

    public function render()
    {
        $this->riwayatRow = RiwayatHarga::get()->count();
        $this->riwayats = RiwayatHarga::latest()->take($this->take)->get();

        return view('livewire.produk.produk-riwayat-harga-page')->extends('layouts.app')->section('content');
    }
}
