<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Kasir;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class PenjualanPage extends Component
{
    public $take = 25;
    public function take()
    {
        $this->take += 25;
    }
    public function render()
    {
        // $this->pendapatan_day = Penjualan::whereDate('created_at', date('Y-m-d'))->get()->sum('pendapatan');
        $this->omset_kemarin = Penjualan::whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->get()->sum('omset');
        $this->untung_kemarin = Penjualan::whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->get()->sum('untung');

        $this->omset_day = Penjualan::whereDate('created_at', date('Y-m-d'))->get()->sum('omset');
        $this->untung_day = Penjualan::whereDate('created_at', date('Y-m-d'))->get()->sum('untung');

        $this->omset_Bkemarin = Penjualan::whereMonth('created_at', date('m', strtotime('-1 month')))->get()->sum('omset');
        $this->untung_Bkemarin = Penjualan::whereMonth('created_at', date('m', strtotime('-1 month')))->get()->sum('untung');

        $this->omset_month = Penjualan::whereMonth('created_at', date('m'))->get()->sum('omset');
        $this->untung_month = Penjualan::whereMonth('created_at', date('m'))->get()->sum('untung');


        $this->penjualanRow = Penjualan::get()->count();
        $penjualan = Penjualan::latest();

        $this->penjualan = $penjualan->take($this->take)->get();

        return view('livewire.penjualan.penjualan-page')->extends('layouts.app')->section('content');
    }
}
