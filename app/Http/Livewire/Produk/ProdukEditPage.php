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

class ProdukEditPage extends Component
{

    public $nama, $img, $tipe, $merek_id, $catalog_id, $kategori_id, $rak_id, $keterangan, $supplier_id;

    public $url = '';
    protected $queryString = [
        'url' => ['except' => ''],
    ];

    public $ID;

    public $merek_input, $catalog_input, $kategori_input, $supplier_input, $rak_input;
    public $merek_show = false, $catalog_show = false, $kategori_show = false, $supplier_show = false, $rak_show = false;
    public $merek_nama, $catalog_nama, $kategori_nama, $rak_nama, $supplier_nama;

    // field item, tambah / edit
    public $barcode1, $barcode2, $barcode3, $barcode4, $barcode5, $barcode6, $satuan_id, $satuan_dasar = 1, $konversi = 1, $harga_pokok, $harga_jual;
    public $editID;
    public $tambahItem = false, $editItem = false;

    public function mount($id)
    {
        $data = Produk::find($id);
        $this->ID = $id;
        $this->nama = $data->nama;
        $this->tipe = $data->tipe;
        $this->merek_id = $data->merek_id;
        $this->merek_nama = $data->merek->nama;
        $this->catalog_id = $data->catalog_id;
        $this->catalog_nama = $data->catalog->nama;
        $this->kategori_id = $data->kategori_id;
        $this->kategori_nama = $data->kategori->nama;
        $this->rak_id = $data->rak_id;
        $this->rak_nama = $data->rak->nama;
        $this->keterangan = $data->keterangan;
        $this->supplier_id = $data->supplier_id;
        $this->supplier_nama = $data->supplier->nama;

        $this->produkItems = ProdukItem::where('produk_id', $id)->get();
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

        $this->produk = Produk::with('produk_item')->find($this->id);

        return view('livewire.produk.produk-edit-page')->extends('layouts.app')->section('content');
    }
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

    //
    // public function resetData()
    // {
    //     $this->ID = null;
    //     $this->nama = null;
    //     $this->tipe = null;
    //     $this->merek_id = null;
    //     $this->catalog_id = null;
    //     $this->kategori_id = null;
    //     $this->rak_id = null;
    //     $this->keterangan = null;
    //     $this->supplier_id = null;
    // }

    public function perbaruiProduk()
    {
        $P = Produk::find($this->ID);
        
        $P->update([
            'nama' => $this->nama,
            'tipe' => $this->tipe,
            'merek_id' => $this->merek_id,
            'catalog_id' => $this->catalog_id,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'keterangan' => $this->keterangan,
            'supplier_id' => $this->supplier_id,
        ]);
    }

    public function simpanProduk()
    {
        $this->perbaruiProduk();
        $this->emit('success', ['pesan' => 'Berhasil edit data']);
        // redirect()->to($this->url);  
    }

    public function simpanBaru()
    {
        $this->perbaruiProduk();
        $this->emit('success', ['pesan' => 'Berhasil edit data']);
        redirect()->to('produk/produk-create');  
    }

    public function simpanClose()
    {
        $this->perbaruiProduk();
        $this->emit('success', ['pesan' => 'Berhasil edit data']);
        redirect()->to($this->url);  
    }

    public function kembali()
    {
        $this->resetData();
        redirect()->to($this->url);  
    }

// ============================================================================
    //  aksi
    public function resetDataItem()
    {
        $this->barcode1 = null;
        $this->barcode2 = null;
        $this->barcode3 = null;
        $this->barcode4 = null;
        $this->barcode5 = null;
        $this->barcode6 = null;
        $this->satuan_id = null;
        $this->satuan_dasar = null;
        $this->konversi = null;
        $this->harga_jual = null;
        $this->harga_pokok = null;
    }

    public function tambahItem()
    {
        if ($this->tambahItem == false) {
            $this->tambahItem = true;
        } else {
            $this->tambahItem = false;
        }
    }

    public function tutupTambahItem()
    {
        $this->resetDataItem();
        $this->tambahItem = false;
    }

    public function simpanTambahItem()
    {
        $item = ProdukItem::create([
            'produk_id' => $this->ID,
            
        ]);
    }

    public function editItem($id)
    {
        $this->editItem = true;
    }

    public function perbaruiItem()
    {
        $this->editID;
    }

    public function hapusItem($id)
    {
        dd($id);
    }
}
