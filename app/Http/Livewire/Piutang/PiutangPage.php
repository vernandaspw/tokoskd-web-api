<?php

namespace App\Http\Livewire\Piutang;

use App\Models\Pelanggan;
use App\Models\Piutang;
use App\Models\Supplier;
use Livewire\Component;

class PiutangPage extends Component
{
    public $total_piutang_pelanggan, $total_piutang_supplier;

    public $takePiutang = 20;

    public $createPage = false, $editPage = false;

    public $siapa;

    public $jml_pelanggan, $jml_supplier;


    public function render()
    {
        $this->jml_pelanggan = Pelanggan::where('piutang_usaha', '>', 0)->get()->count();
        $this->jml_supplier = Supplier::where('piutang_usaha', '>', 0)->get()->count();

        $this->piutang = Piutang::take($this->takePiutang)->latest()->get();

        $this->total_piutang_pelanggan = Pelanggan::get()->sum('piutang_usaha');
        $this->total_piutang_supplier = Supplier::get()->sum('piutang_usaha');

        return view('livewire.piutang.piutang-page')->extends('layouts.app')->section('content');
    }

    public function takePiutang()
    {
        $this->takePiutang += 20;
    }
}
