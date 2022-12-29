<?php

namespace App\Http\Livewire\Master;

use App\Models\Satuan;
use Livewire\Component;

class SatuanPage extends Component
{
    public $satuans = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $satuan, $keterangan, $isaktif;

    public function render()
    {
        $this->satuans = Satuan::latest()->take($this->take)->get();
        return view('livewire.master.satuan-page')->extends('layouts.app')->section('content');
    }
    public function next()
    {
        $this->take += 10;
    }

    public function aktifkan($id)
    {
        Satuan::find($id)->update([
            'isaktif' => true,
        ]);
    }

    public function nonaktifkan($id)
    {
        Satuan::find($id)->update([
            'isaktif' => false,
        ]);
    }

    // TAMBAH
    public function tambahPage()
    {
        if ($this->tambahPage == false) {
            $this->tambahPage = true;
        } else {
            $this->tambahPage = false;
        }
    }

    public function simpan()
    {
        $this->validate([
            'satuan' => 'required',
            'keterangan' => '',
        ]);

        Satuan::create([
            'satuan' => $this->satuan,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();

        $this->emit('success', ['pesan' => 'Berhasil simpan data']);


    }

    // EDIT
    public function editPage($id)
    {
        $user = Satuan::find($id);
        $this->ID = $user->id;
        $this->satuan = $user->satuan;
        $this->keterangan = $user->keterangan;
        $this->isaktif = $user->isaktif;

        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->satuan = null;
        $this->keterangan = null;
        $this->isaktif = null;
    }

    public function editPageClose()
    {
        $this->resetData();
        $this->editPage = false;
    }

    public function edit()
    {
        $user = Satuan::find($this->ID);

        $user->update([
            'satuan' => $this->satuan,
            'keterangan' => $this->keterangan,
            'isaktif' => $this->isaktif
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

    }
}
