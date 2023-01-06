<?php

namespace App\Http\Livewire\Hutang;

use App\Models\Hutang;
use App\Models\Hutang\HutangData;
use App\Models\Pelanggan;
use App\Models\Supplier;
use Livewire\Component;

class HutangPage extends Component
{
    public $total_hutang_pelanggan, $total_hutang_supplier;

    public $takeHutang = 20;

    public $createPage = false, $editPage = false;

    public $siapa;

    public $jml_pelanggan, $jml_supplier;

    public function render()
    {
        $this->jml_pelanggan = Pelanggan::where('hutang_usaha', '>', 0)->get()->count();
        $this->jml_supplier = Supplier::where('hutang_usaha', '>', 0)->get()->count();

        $this->hutang = Hutang::take($this->takeHutang)->latest()->get();

        $this->total_hutang_pelanggan = Pelanggan::get()->sum('hutang_usaha');
        $this->total_hutang_supplier = Supplier::get()->sum('hutang_usaha');

        return view('livewire.hutang.hutang-page')->extends('layouts.app')->section('content');
    }

    public function takeHutang()
    {
        $this->takeHutang += 20;
    }

}
