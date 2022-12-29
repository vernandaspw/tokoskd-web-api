<?php

namespace App\Http\Livewire\Master;

use App\Models\Rak;
use Livewire\Component;

class RakPage extends Component
{


    public $raks = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $nama, $keterangan;

    public function render()
    {
        $this->raks = Rak::latest()->take($this->take)->get();
        return view('livewire.master.rak-page')->extends('layouts.app')->section('content');
    }
    public function next()
    {
        $this->take += 10;
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
            'nama' => 'required',
            'keterangan' => '',
        ]);


        Rak::create([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();

        $this->emit('success', ['pesan' => 'Berhasil simpan data']);


    }

    // EDIT
    public function editPage($id)
    {
        $data = Rak::find($id);
        $this->ID = $data->id;
        $this->nama = $data->nama;
        $this->keterangan = $data->keterangan;

        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->nama = null;
        $this->keterangan = null;
    }

    public function editPageClose()
    {
        $this->resetData();
        $this->editPage = false;
    }

    public function edit()
    {
        $data = Rak::find($this->ID);

        $data->update([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

    }

    public function hapus($id)
    {
        $data = Rak::find($id);
        $data->delete();

        $this->emit('success', ['pesan' => 'Berhasil hapus data']);
    }
}
