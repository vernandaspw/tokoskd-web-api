<?php

namespace App\Http\Livewire\Produk;

use App\Models\Catalog;
use App\Models\Kategori;
use App\Models\Merek;
use App\Models\Produk;
use App\Models\ProdukItem;
use App\Models\Rak;
use App\Models\Satuan;
use App\Models\Supplier;
use Livewire\Component;

class ProdukCreatePage extends Component
{
    public $ID;
    public $Pid;
    public $nama, $img, $tipe, $merek_id, $catalog_id, $kategori_id, $rak_id, $keterangan, $supplier_id;

    public $url = '';
    protected $queryString = [
        'url' => ['except' => ''],
    ];

    public $merek_input, $catalog_input, $kategori_input, $supplier_input, $rak_input;
    public $merek_show = false, $catalog_show = false, $kategori_show = false, $supplier_show = false, $rak_show = false;
    public $merek_nama, $catalog_nama, $kategori_nama, $rak_nama, $supplier_nama;

    public $produkItem = [];

    public $barcode1, $barcode2, $barcode3, $barcode4, $barcode5, $barcode6, $satuan_id, $konversi = 1,  $harga_pokok, $harga_jual;

    public function merek_id($id)
    {
        $this->merek_id = $id;
        $this->merek_nama = Merek::find($id)->nama;
        $this->merek_toggle();
    }
    public function merek_toggle()
    {
        if ($this->merek_show == true) {
            $this->merek_input = null;
            $this->merek_show = false;
        } else {
            $this->merek_input = null;
            $this->merek_show = true;
        }
    }

    public function catalog_id($id)
    {
        $this->catalog_id = $id;
        $this->catalog_nama = Catalog::find($id)->nama;
        $this->catalog_toggle();
    }
    public function catalog_toggle()
    {
        if ($this->catalog_show == true) {
            $this->catalog_input = null;
            $this->catalog_show = false;
        } else {
            $this->catalog_input = null;
            $this->catalog_show = true;
        }
    }

    public function kategori_id($id)
    {
        $this->kategori_id = $id;
        $this->kategori_nama = Kategori::find($id)->nama;
        $this->kategori_toggle();
    }
    public function kategori_toggle()
    {
        if ($this->kategori_show == true) {
            $this->kategori_input = null;
            $this->kategori_show = false;
        } else {
            $this->kategori_input = null;
            $this->kategori_show = true;
        }
    }

    public function rak_id($id)
    {
        $this->rak_id = $id;
        $this->rak_nama = Rak::find($id)->nama;
        $this->rak_toggle();
    }
    public function rak_toggle()
    {
        if ($this->rak_show == true) {
            $this->rak_input = null;
            $this->rak_show = false;
        } else {
            $this->rak_input = null;
            $this->rak_show = true;
        }
    }

    public function supplier_id($id)
    {
        $this->supplier_id = $id;
        $this->supplier_nama = Supplier::find($id)->nama;
        $this->supplier_toggle();
    }
    public function supplier_toggle()
    {
        if ($this->supplier_show == true) {
            $this->supplier_input = null;
            $this->supplier_show = false;
        } else {
            $this->supplier_input = null;
            $this->supplier_show = true;
        }
    }



    public function render()
    {
        $merek = Merek::latest();
        if ($this->merek_input) {
            $merek->where('nama', 'LIKE', '%' . $this->merek_input . '%');
            $this->merek_show = true;
        }
        $this->merek = $merek->get();

        $catalog = Catalog::latest();
        if ($this->catalog_input) {
            $catalog->where('nama', 'LIKE', '%' . $this->catalog_input . '%');
            $this->catalog_show = true;
        }
        $this->catalog = $catalog->get();

        $kategori = Kategori::latest();
        if ($this->kategori_input) {
            $kategori->where('nama', 'LIKE', '%' . $this->kategori_input . '%');
            $this->kategori_show = true;
        }
        $this->kategori = $kategori->where('catalog_id', $this->catalog_id)->get();

        $rak = Rak::latest();
        if ($this->rak_input) {
            $rak->where('nama', 'LIKE', '%' . $this->rak_input . '%');
            $this->rak_show = true;
        }
        $this->rak = $rak->get();

        $supplier = Supplier::latest();
        if ($this->supplier_input) {
            $supplier->where('nama', 'LIKE', '%' . $this->supplier_input . '%');
            $this->supplier_show = true;
        }
        $this->supplier = $supplier->get();

        $this->satuans = Satuan::get();

        return view('livewire.produk.produk-create-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->ID = null;
        $this->nama = null;
        $this->tipe = null;
        $this->merek_id = null;
        $this->catalog_id = null;
        $this->kategori_id = null;
        $this->rak_id = null;
        $this->keterangan = null;
        $this->supplier_id = null;

        $this->barcode1 = null;
        $this->barcode2 = null;
        $this->barcode3 = null;
        $this->barcode4 = null;
        $this->barcode5 = null;
        $this->barcode6 = null;
        $this->satuan_id = null;
        $this->harga_pokok = null;
        $this->harga_jual = null;
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
        // if ($this->img) {
        //     $img = $this->img->store('img/produk');
        // } else {
        //     $img = null;
        // }
       $P = Produk::create([
            'nama' => $this->nama,
            'tipe' => $this->tipe,
            'merek_id' => $this->merek_id,
            'catalog_id' => $this->catalog_id,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'keterangan' => $this->keterangan,
            'supplier_id' => $this->supplier_id,
        ]);
        $this->Pid = $P->id;
        ProdukItem::create([
            'produk_id' => $P->id,
            'barcode1' => $this->barcode1,
            'barcode2' => $this->barcode2,
            'barcode3' => $this->barcode3,
            'barcode4' => $this->barcode4,
            'barcode5' => $this->barcode5,
            'barcode6' => $this->barcode6,
            'satuan_id' => $this->satuan_id,

            'konversi' => 1,
            'harga_pokok' => $this->harga_pokok != null ? $this->harga_pokok : 0,
            'harga_jual' => $this->harga_jual != null ? $this->harga_jual : 0
        ]);
        // $storage = Storage::disk('public');
        // if ($storage) {
        //     foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
        //         $storage->delete($filePathname);
        //     }
        // }

        $this->resetData();


    }

    public function simpanBaru()
    {
        $this->simpan();
        $this->emit('success', ['pesan' => 'Berhasil buat data']);
        // redirect()->to($this->url);
    }

    public function simpanClose()
    {
        $this->simpan();
        $this->emit('success', ['pesan' => 'Berhasil buat data']);
        redirect()->to($this->url);
    }

    public function simpanEdit()
    {
        $this->simpan();
        $this->emit('success', ['pesan' => 'Berhasil buat data']);
        redirect()->to('produk/produk-edit/'. $this->Pid);
    }

    public function kembali()
    {
        $this->resetData();
        redirect()->to($this->url);
    }

}
