<?php

namespace App\Http\Livewire\Master;

use App\Models\Catalog;
use App\Models\Kategori;
use Livewire\Component;

class KategoriPage extends Component
{
    public $catalogs = [], $kategoris = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $catalog, $nama, $keterangan;

    public function render()
    {
        $this->catalogs = Catalog::latest()->get();
        $this->kategoris = Kategori::with('catalog')->latest()->take($this->take)->get();
        return view('livewire.master.kategori-page')->extends('layouts.app')->section('content');
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
            'catalog' => 'required',
            'nama' => 'required',
            'keterangan' => '',
        ]);
        Kategori::create([
            'catalog_id' => $this->catalog,
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);
        $this->resetData();
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
    }

    // EDIT
    public function editPage($id)
    {
        $data = Kategori::find($id);
        $this->ID = $data->id;
        $this->catalog = $data->catalog_id;
        $this->nama = $data->nama;
        $this->keterangan = $data->keterangan;

        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->catalog = null;
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
        $data = Kategori::find($this->ID);

        $data->update([
            'catalog_id' => $this->catalog,
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

    }

    public function hapus($id)
    {
        $data = Kategori::find($id);
        $data->delete();

        $this->emit('success', ['pesan' => 'Berhasil hapus data']);
    }
}
