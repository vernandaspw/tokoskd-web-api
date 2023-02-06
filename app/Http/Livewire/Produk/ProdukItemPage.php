<?php

namespace App\Http\Livewire\Produk;

use App\Models\ProdukItem;
use Livewire\Component;

class ProdukItemPage extends Component
{
    public $produkItems = [];

    public $take = 20;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $catalog, $nama, $keterangan;

    public $cariProduk;

    public $cekBarcode1;
    public $cekBarcode2;
    public $cekBarcode3;
    public $cekBarcode4;
    public $cekBarcode5;
    public $cekBarcode6;

    protected $listeners = [
        'take-data' => 'next',
    ];

    public function render()
    {
        // dd($this->cekBarcode1);
        $pItem = ProdukItem::with('produk');

        if ($this->cariProduk) {
            $pItem->whereRelation('produk', 'nama', 'like', '%' . $this->cariProduk . '%')
            ->orWhere('barcode1', $this->cariProduk)
            ->orWhere('barcode2', $this->cariProduk)
            ->orWhere('barcode3', $this->cariProduk)
            ->orWhere('barcode4', $this->cariProduk)
            ->orWhere('barcode5', $this->cariProduk)
            ->orWhere('barcode6', $this->cariProduk);
        }

        if ($this->cekBarcode1) {
            $pItem->where('barcode1', null);
        }

         if ($this->cekBarcode2) {
            $pItem->where('barcode2', null);
        }
        if ($this->cekBarcode3) {
            $pItem->where('barcode3', null);
        }
        if ($this->cekBarcode4) {
            $pItem->where('barcode4', null);
        }
        if ($this->cekBarcode5) {
            $pItem->where('barcode5', null);
        }
        if ($this->cekBarcode6) {
            $pItem->where('barcode6', null);
        }

        $pItem->latest()->take($this->take);


        $this->produkItems = $pItem->get();

        return view('livewire.produk.produk-item-page')->extends('layouts.app')->section('content');
    }
    public function next()
    {
        $this->take += 20;
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
        $data = ProdukItem::find($id)->delete();

        $this->emit('success', ['pesan' => 'Berhasil hapus item']);
    }

}
