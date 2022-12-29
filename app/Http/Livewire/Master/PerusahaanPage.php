<?php

namespace App\Http\Livewire\Master;

use App\Models\Perusahaan;
use Livewire\Component;

class PerusahaanPage extends Component
{
    public $img, $nama_toko, $provinsi, $daerah, $alamat, $telp, $npwp;

    public $perusahaan = [];

    public function mount()
    {
        $data = Perusahaan::first();
        $this->nama_toko = $data->nama_toko;
        $this->img = $data->img;
        $this->provinsi = $data->provinsi;
        $this->daerah = $data->daerah;
        $this->alamat = $data->alamat;
        $this->telp = $data->telp;
        $this->npwp = $data->npwp;
    }

    public function render()
    {
        $this->perusahaan = Perusahaan::first();

        return view('livewire.master.perusahaan-page')->extends('layouts.app')->section('content');
    }

    public function simpan()
    {
        $data = Perusahaan::first();

        $data->update([
            'nama_toko' => $this->nama_toko,
            'img' => $this->img,
            'provinsi' => $this->provinsi,
            'daerah' => $this->daerah,
            'alamat' => $this->alamat,
            'telp' => $this->telp,
            'npwp' => $this->npwp,
        ]);

        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
    }
}
