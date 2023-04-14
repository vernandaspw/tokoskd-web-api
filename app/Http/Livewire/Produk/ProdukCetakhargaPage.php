<?php

namespace App\Http\Livewire\Produk;

use App\Models\CetakHarga;
use Livewire\Component;

class ProdukCetakhargaPage extends Component
{
    public $datas = [];

    public function render()
    {
        $this->datas = CetakHarga::orderBy('produk_id', 'ASC')->latest()->get();

        return view('livewire.produk.produk-cetakharga-page')->extends('layouts.app')->section('content');
    }

    public function hapus($id)
    {
        CetakHarga::find($id)->delete();

        // $this->emit('success', ['pesan' => 'Berhasil hapus data']);
    }

    public function resetAll()
    {
        $data = CetakHarga::get();
        foreach ($data as $d) {
            $d->delete();
        }

        // $this->emit('success', ['pesan' => 'Berhasil hapus data']);
    }


    public function cetakSemua()
    {
        $this->emit('cetakData', ['url' => url('struk/cetak-harga'), 'title' => 'struk cetak harga ']);
    }


}
