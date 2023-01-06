<?php

namespace App\Http\Livewire\Piutang;

use Livewire\Component;

class PiutangPelangganPage extends Component
{
    public $total_hutang_pelanggan, $total_hutang_supplier;

    public $jml_orang;

    public $takePelanggan = 20;
    public $cariNama;

    public $tambahPage = false, $kurangPage = false;

    public $d_id, $d_nama, $d_hutang, $d_kas_id, $d_jumlah, $d_keterangan;

    public function render()
    {
        $pelanggan = Pelanggan::take($this->takePelanggan)->orderBy('hutang_usaha', 'desc');
        if ($this->cariNama) {
            $pelanggan->where('nama', 'like', '%' . $this->cariNama . '%');
        }
        $this->pelanggan = $pelanggan->get();

        $this->jml_orang = Pelanggan::where('hutang_usaha', '>', 0)->get()->count();
        $this->total_hutang_pelanggan = Pelanggan::get()->sum('hutang_usaha');

        $this->kas = Kas::where('isaktif', true)->get();

        return view('livewire.piutang.piutang-pelanggan-page')->extends('layouts.app')->section('content');
    }
}
