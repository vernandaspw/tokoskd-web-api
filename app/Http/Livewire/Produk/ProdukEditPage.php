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

    public $barcode1, $barcode2, $barcode3, $barcode4, $barcode5, $barcode6, $satuan_id, $konversi = 1, $harga_pokok, $harga_jual;
    public $editID;
    public $tambahItem = false, $editItem = false;

    public $e_barcode1, $e_barcode2, $e_barcode3, $e_barcode4, $e_barcode5, $e_barcode6, $e_satuan_id, $e_konversi = 1, $e_harga_pokok, $e_harga_jual;

    public $satuanDasar;

    public function generateHargaPokok()
    {
        $id = $this->ID;
        $produk = Produk::with('produk_item')->find($id);
        $min = $produk->produk_item->min('konversi');
        $max = $produk->produk_item->max('konversi');
        // dd($produk);

        foreach ($produk->produk_item as $data) {
            $dataMax = $produk->produk_item->where('konversi', $max)->first();
            $dataMin = $produk->produk_item->where('konversi', $min)->first();

            // cek data max
            if ($data->id == $dataMax->id) {
                // merubah harga jual , jika harga jual dibawah harga pokok
                if ($data->harga_pokok > $data->harga_jual) {
                    $dataMax->update([
                        'harga_jual' => $dataMax->harga_pokok,
                    ]);
                }
            } else {
                $data->update([
                    'harga_pokok' =>  $dataMax->harga_pokok / $dataMax->konversi * $data->konversi,
                ]);

            }
        }

        $this->emit('success', ['pesan' => 'Berhasil generate harga']);
    }

    public function generateHargaJual()
    {
        $id = $this->ID;
        $produk = Produk::find($id);
        $min = $produk->produk_item->min('konversi');
        $max = $produk->produk_item->max('konversi');

        foreach ($produk->produk_item as $data) {
            $dataMax = $produk->produk_item->where('konversi', $max)->first();
            $dataMin = $produk->produk_item->where('konversi', $min)->first();

            if ($data->id == $dataMax->id) {
                // merubah harga jual , jika harga jual dibawah harga pokok
                if ($data->harga_pokok > $data->harga_jual) {
                    $data->update([
                        'harga_jual' => $dataMax->harga_pokok,
                    ]);
                }
            } else {
                if ($data->harga_pokok > $data->harga_jual) {
                    $hargaTerbaru = $dataMax->harga_pokok;
                } else {
                    $hargaTerbaru = $dataMax->harga_jual;
                }
                $data->update([
                    'harga_jual' => $hargaTerbaru / $dataMax->konversi * $data->konversi,
                ]);
            }
        }

        $this->emit('success', ['pesan' => 'Berhasil generate harga']);
    }

    public function mount($id)
    {
        $data = Produk::find($id);
        $this->ID = $id;
        $this->nama = $data->nama;
        $this->tipe = $data->tipe;
        $this->merek_id = $data->merek_id;
        $this->merek_nama = $data->merek ? $data->merek->nama : null;
        $this->catalog_id = $data->catalog_id;
        $this->catalog_nama = $data->catalog ? $data->catalog->nama : null;
        $this->kategori_id = $data->kategori_id;
        $this->kategori_nama = $data->kategori ? $data->kategori->nama : null;
        $this->rak_id = $data->rak_id;
        $this->rak_nama = $data->rak ? $data->rak->nama : null;
        $this->keterangan = $data->keterangan;
        $this->supplier_id = $data->supplier_id;
        $this->supplier_nama = $data->supplier ? $data->supplier->nama : null;
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
        $this->produkItems = ProdukItem::where('produk_id', $this->ID)->orderBy('konversi', 'ASC')->get();

        // $d = ProdukItem::where('produk_id', $this->ID)->where('satuan_dasar', true)->first();
        // $this->satuanDasar = $d != null ? $d->satuan->satuan : null;

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
        // $this->resetData();
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

        $this->konversi = null;
        $this->harga_jual = null;
        $this->harga_pokok = null;
    }

    public function tambahItem()
    {
        if ($this->tambahItem == false) {
            $this->resetDataItem();
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
            'barcode1' => $this->barcode1,
            'barcode2' => $this->barcode2,
            'barcode3' => $this->barcode3,
            'barcode4' => $this->barcode4,
            'barcode5' => $this->barcode5,
            'barcode6' => $this->barcode6,
            'satuan_id' => $this->satuan_id,

            'konversi' => $this->konversi,
            'harga_pokok' => $this->harga_pokok,
            'harga_jual' => $this->harga_jual,
        ]);

        $this->resetDataItem();

        $this->emit('success', ['pesan' => 'Berhasil tambah item']);
    }
    // edit

    public function editItem($id)
    {
        $this->editItem = true;
        $item = ProdukItem::find($id);
        $this->editID = $id;
        $this->barcode1 = $item->barcode1;
        $this->barcode2 = $item->barcode2;
        $this->barcode3 = $item->barcode3;
        $this->barcode4 = $item->barcode4;
        $this->barcode5 = $item->barcode5;
        $this->barcode6 = $item->barcode6;
        $this->satuan_id = $item->satuan_id;

        $this->konversi = $item->konversi;
        $this->harga_pokok = $item->harga_pokok;
        $this->harga_jual = $item->harga_jual;
    }

    public function perbaruiItem()
    {
        ProdukItem::find($this->editID)->update([
            'barcode1' => $this->barcode1,
            'barcode2' => $this->barcode2,
            'barcode3' => $this->barcode3,
            'barcode4' => $this->barcode4,
            'barcode5' => $this->barcode5,
            'barcode6' => $this->barcode6,
            'satuan_id' => $this->satuan_id,

            'konversi' => $this->konversi,
            'harga_pokok' => $this->harga_pokok,
            'harga_jual' => $this->harga_jual,
        ]);

        $this->emit('success', ['pesan' => 'Berhasil edit item']);
        $this->editID = null;
    }

    public function hapusItem($id)
    {
        $data = ProdukItem::find($id)->delete();

        $this->emit('success', ['pesan' => 'Berhasil hapus item']);
    }

    public function tutupEditItem()
    {
        $this->resetDataItem();
        $this->editItem = false;
    }
}
