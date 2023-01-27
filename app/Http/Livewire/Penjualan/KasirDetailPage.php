<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\AppModel;
use App\Models\CardItem;
use App\Models\Catalog;
use App\Models\Kasir;
use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Kategori;
use App\Models\Merek;
use App\Models\Pelanggan;
use App\Models\Penjualan\Penjualan;
use App\Models\Penjualan\PenjualanItem;
use App\Models\Piutang;
use App\Models\Produk;
use App\Models\ProdukItem;
use App\Models\Rak;
use App\Models\RiwayatHarga;
use App\Models\StokJenis;
use App\Models\StokKategori;
use App\Models\StokTransaksi;
use Livewire\Component;

class KasirDetailPage extends Component
{
    public $produkitem = [];
    public $takeprodukitem = 25;

    public $selectMerek, $selectCatalog, $selectKategori, $selectRak;
    public $cariProduk, $cariBarcode, $orderBy;

    public $itemID, $qtyEdit;

    public $menuManual = false, $menuBuatBaru = false;

    public $kasirID;

    public function menuProduk()
    {
        $this->menuManual = false;
        $this->menuBuatBaru = false;
    }

    public function menuManual()
    {
        $this->menuManual = true;
        $this->menuBuatBaru = false;
    }

    public function menuBuatBaru()
    {
        $this->menuManual = false;
        $this->menuBuatBaru = true;
    }

    public function editItem($id)
    {
        $this->itemID = $id;
        $d = CardItem::find($id);
        $this->qtyEdit = $d->qty;
    }

    public function mount($id)
    {
        $this->kasirID = $id;
        $this->waktu = now();
    }

    public function render()
    {
        $this->kasir = Kasir::find($this->kasirID)->first();
        // dd($this->kasir);
        $pi = ProdukItem::with('produk');
        if ($this->cariBarcode) {
            $data = $pi->where('barcode1', $this->cariBarcode)
                ->orWhere('barcode2', $this->cariBarcode)
                ->orWhere('barcode3', $this->cariBarcode)
                ->orWhere('barcode4', $this->cariBarcode)
                ->orWhere('barcode5', $this->cariBarcode)
                ->orWhere('barcode6', $this->cariBarcode)->first();
            if ($data) {
                // cek diskon
                $id = $data->id;
                $this->addCardItem($id);
                $this->itemID = null;
                $this->cariBarcode = null;
            }
        }
        if ($this->cariProduk) {
            $pi->whereRelation('produk', 'nama', 'like', '%' . $this->cariProduk . '%');
        }
        if ($this->selectMerek) {
            $pi->whereRelation('produk', 'merek_id', $this->selectMerek);
        }
        if ($this->selectCatalog) {
            $pi->whereRelation('produk', 'catalog_id', $this->selectCatalog);
        }
        if ($this->selectKategori) {
            $pi->whereRelation('produk', 'kategori_id', $this->selectKategori);
        }
        if ($this->selectRak) {
            $pi->whereRelation('produk', 'rak_id', $this->selectRak);
        }
        if ($this->orderBy == null || $this->orderBy == 'terbaru') {
            $pi->orderBy('created_at', 'desc');
        }
        if ($this->orderBy == 'diskon terbesar') {

            // cek tanggal lalu cek jam
            // dd(date('Y-m-d'));
            if ($pi->where('diskon_start', '<=', date('Y-m-d')) && $pi->where('diskon_end', '>', date('Y-m-d'))) {
                if ($pi->where('jam_start', '!=', null) && $pi->where('jam_end', '!=', null)) {
                    if ($pi->where('jam_start', '<=', date('H:i:s')) && $pi->where('jam_end', '>=', date('H:i:s'))) {
                        $pi->orderBy('diskon_harga_jual', 'desc');
                    }
                } else {
                    $pi->orderBy('diskon_harga_jual', 'desc');
                }
            }
        }
        $this->produkitem = $pi->take($this->takeprodukitem)->get();

        $this->mereks = Merek::latest()->get();
        $this->catalogs = Catalog::latest()->get();
        $this->kategoris = Kategori::latest()->get();
        $this->raks = Rak::latest()->get();

        $this->carditem = CardItem::get();

        // if ($this->ubahHargaJualDasar == null) {
        //     $this->ubahHargaJualDasar = 0;
        // }

        $pelanggans = Pelanggan::take($this->pelanggan_take)->orderBy('nama', 'asc');
        if ($this->CariPelanggan) {
            $pelanggans->where('nama', 'like', '%' . $this->CariPelanggan . '%')->orWhere('phone', 'like', '%' . $this->CariPelanggan . '%');
        }
        $this->pelanggans = $pelanggans->get();

        // Transaksi
        $cartSaya = CardItem::where('user_id', auth()->user()->id)->get();
        $this->total_harga_jual = $cartSaya->sum('total_harga_jual');
        $this->total_harga_pokok = $cartSaya->sum('total_harga_modal');
        $pajak = AppModel::pajak();
        $this->total_potongan_diskon = $cartSaya->sum('potongan_diskon');
        $this->total_harga = $cartSaya->sum('total_harga');
        $this->pajak = $this->total_harga * $pajak / 100;

        if ($this->pelanggan_id) {
            $pot_ht = Pelanggan::find($this->pelanggan_id)->hutang_usaha;
            $this->tagihan_utang = Pelanggan::find($this->pelanggan_id)->piutang_usaha;
        } else {
            $pot_ht = 0;
            $this->tagihan_utang = 0;
        }

        if ($this->ongkir == null) {
            $ongkir = 0;
        } else {
            $ongkir = $this->ongkir;
        }

        $jml = $this->total_harga + $this->pajak + $ongkir + $this->tagihan_utang;

        // if ($pot_ht > $jml) {
        //     $sisa_ht = $pot_ht - $jml;
        //     $this->total_potongan_utang_toko = $pot_ht - $sisa_ht;
        // } else {
        //     $this->total_potongan_utang_toko = $pot_ht;
        // }

        $this->total_pembayaran = $jml;

        //
        if ($this->diterima == null) {
            $diterima = 0;
        } else {
            $diterima = $this->diterima;
        }
        $this->kembali = $diterima - $this->total_pembayaran;

        return view('livewire.penjualan.kasir-detail-page')->extends('layouts.app')->section('content');
    }

    public function updated()
    {
        if ($this->itemID) {
            if ($this->qtyEdit) {
                $ci = CardItem::find($this->itemID);
                $data = ProdukItem::find($ci->produk_item_id);

                if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d')) {
                    if ($data->jam_start != null && $data->jam_end != null) {
                        if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s')) {
                            $harga_jual = $data->diskon_harga_jual;
                            $persenDiskon = $data->diskon_persen;
                        } else {
                            $harga_jual = $data->harga_jual;
                            $isDiskon = false;
                            $persenDiskon = 0;
                        }
                    } else {
                        $harga_jual = $data->diskon_harga_jual;
                        $persenDiskon = $data->diskon_persen;
                    }
                } else {
                    $harga_jual = $data->harga_jual;
                    $persenDiskon = 0;
                }

                // cardItem ubah
                $qty = $this->qtyEdit;
                $total_harga_modal = $data->harga_pokok * $qty;
                $total_harga_jual = $harga_jual * $qty;
                $total_potongan_diskon = ($harga_jual * ($persenDiskon / 100)) * $qty;
                $total_harga = $total_harga_jual - $total_potongan_diskon;
                $untung = $total_harga - $total_harga_modal;
                $ci->update([
                    'harga_jual' => $harga_jual,
                    'diskon_persen' => $persenDiskon,
                    'qty' => $qty,
                    'total_harga_modal' => $total_harga_modal,
                    'total_harga_jual' => $total_harga_jual,
                    'potongan_diskon' => $total_potongan_diskon,
                    'total_harga' => $total_harga,
                    'untung' => $untung,
                ]);

            }
        }
    }

    public function addNewCardItem($id)
    {
        $this->addCardItem($id);
        $this->itemID = null;
    }

    public function addCardItem($id)
    {
        $data = ProdukItem::find($id);
        if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d')) {
            if ($data->jam_start != null && $data->jam_end != null) {
                if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s')) {
                    $harga_jual = $data->diskon_harga_jual;
                    $persenDiskon = $data->diskon_persen;
                } else {
                    $harga_jual = $data->harga_jual;
                    $persenDiskon = 0;
                }
            } else {
                $harga_jual = $data->diskon_harga_jual;
                $persenDiskon = $data->diskon_persen;
            }
        } else {
            $harga_jual = $data->harga_jual;
            $persenDiskon = 0;
        }

        $cartitem = CardItem::where('produk_item_id', $data->id)->first();
        if ($cartitem) {
            $qty = $cartitem->qty + 1;
            $total_harga_modal = $data->harga_pokok * $qty;
            $total_harga_jual = $harga_jual * $qty;
            $total_potongan_diskon = ($harga_jual * ($persenDiskon / 100)) * $qty;
            $total_harga = $total_harga_jual - $total_potongan_diskon;
            $untung = $total_harga - $total_harga_modal;

            $cartitem->update([
                'user_id' => auth()->user()->id,
                'produk_id' => $data->produk->id,
                'merek_id' => $data->produk->merek_id,
                'catalog_id' => $data->produk->catalog_id,
                'kategori_id' => $data->produk->kategori_id,
                'rak_id' => $data->produk->rak_id,
                'produk_item_id' => $data->id,
                'satuan_id' => $data->satuan_id,
                'harga_modal' => $data->harga_pokok,
                'harga_jual' => $harga_jual,
                'diskon_persen' => $persenDiskon,
                'qty' => $qty,
                'total_harga_modal' => $total_harga_modal,
                'total_harga_jual' => $total_harga_jual,
                'potongan_diskon' => $total_potongan_diskon,
                'total_harga' => $total_harga,
                'untung' => $untung,
            ]);
        } else {
            $potongan_diskon = $harga_jual * ($persenDiskon / 100);
            $total_harga = $harga_jual - $potongan_diskon;
            $untung = $total_harga - $data->harga_pokok;

            CardItem::create([
                'user_id' => auth()->user()->id,
                'produk_id' => $data->produk->id,
                'merek_id' => $data->produk->merek_id,
                'catalog_id' => $data->produk->catalog_id,
                'kategori_id' => $data->produk->kategori_id,
                'rak_id' => $data->produk->rak_id,
                'produk_item_id' => $data->id,
                'satuan_id' => $data->satuan_id,
                'harga_modal' => $data->harga_pokok,
                'harga_jual' => $harga_jual,
                'diskon_persen' => $persenDiskon,
                'qty' => 1,
                'total_harga_modal' => $data->harga_pokok,
                'total_harga_jual' => $harga_jual,
                'potongan_diskon' => $potongan_diskon,
                'total_harga' => $total_harga,
                'untung' => $untung,
            ]);
        }
    }

    public function tambahQty($id)
    {
        $cartitem = CardItem::find($id);
        $data = ProdukItem::find($cartitem->produk_item_id);
        if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d')) {
            if ($data->jam_start != null && $data->jam_end != null) {
                if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s')) {
                    $harga_jual = $data->diskon_harga_jual;
                    $persenDiskon = $data->diskon_persen;
                } else {
                    $harga_jual = $data->harga_jual;
                    $isDiskon = false;
                    $persenDiskon = 0;
                }
            } else {
                $harga_jual = $data->diskon_harga_jual;
                $persenDiskon = $data->diskon_persen;
            }
        } else {
            $harga_jual = $data->harga_jual;
            $persenDiskon = 0;
        }

        $qty = $cartitem->qty + 1;
        $this->qtyEdit = $qty;
        $total_harga_modal = $data->harga_pokok * $qty;
        $total_harga_jual = $harga_jual * $qty;
        $total_potongan_diskon = ($harga_jual * ($persenDiskon / 100)) * $qty;
        $total_harga = $total_harga_jual - $total_potongan_diskon;
        $untung = $total_harga - $total_harga_modal;

        $cartitem->update([
            'user_id' => auth()->user()->id,
            'produk_id' => $data->produk->id,
            'merek_id' => $data->produk->merek_id,
            'catalog_id' => $data->produk->catalog_id,
            'kategori_id' => $data->produk->kategori_id,
            'rak_id' => $data->produk->rak_id,
            'produk_item_id' => $data->id,
            'satuan_id' => $data->satuan_id,
            'harga_modal' => $data->harga_pokok,
            'harga_jual' => $harga_jual,
            'diskon_persen' => $persenDiskon,
            'qty' => $qty,
            'total_harga_modal' => $total_harga_modal,
            'total_harga_jual' => $total_harga_jual,
            'potongan_diskon' => $total_potongan_diskon,
            'total_harga' => $total_harga,
            'untung' => $untung,
        ]);

        $this->itemID = null;
    }

    public function kurangQty($id)
    {
        $cartitem = CardItem::find($id);
        $data = ProdukItem::find($cartitem->produk_item_id);
        if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d')) {
            if ($data->jam_start != null && $data->jam_end != null) {
                if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s')) {
                    $harga_jual = $data->diskon_harga_jual;
                    $persenDiskon = $data->diskon_persen;
                } else {
                    $harga_jual = $data->harga_jual;
                    $isDiskon = false;
                    $persenDiskon = 0;
                }
            } else {
                $harga_jual = $data->diskon_harga_jual;
                $persenDiskon = $data->diskon_persen;
            }
        } else {
            $harga_jual = $data->harga_jual;
            $persenDiskon = 0;
        }

        $cartitem = CardItem::where('produk_item_id', $data->id)->first();

        if ($cartitem->qty > 1) {

            $qty = $cartitem->qty - 1;
            $this->qtyEdit = $qty;
            $total_harga_modal = $data->harga_pokok * $qty;
            $total_harga_jual = $harga_jual * $qty;
            $total_potongan_diskon = ($harga_jual * ($persenDiskon / 100)) * $qty;
            $total_harga = $total_harga_jual - $total_potongan_diskon;
            $untung = $total_harga - $total_harga_modal;

            $cartitem->update([
                'user_id' => auth()->user()->id,
                'produk_id' => $data->produk->id,
                'merek_id' => $data->produk->merek_id,
                'catalog_id' => $data->produk->catalog_id,
                'kategori_id' => $data->produk->kategori_id,
                'rak_id' => $data->produk->rak_id,
                'produk_item_id' => $data->id,
                'satuan_id' => $data->satuan_id,
                'harga_modal' => $data->harga_pokok,
                'harga_jual' => $harga_jual,
                'diskon_persen' => $persenDiskon,
                'qty' => $qty,
                'total_harga_modal' => $total_harga_modal,
                'total_harga_jual' => $total_harga_jual,
                'potongan_diskon' => $total_potongan_diskon,
                'total_harga' => $total_harga,
                'untung' => $untung,
            ]);

        }

        $this->itemID = null;

    }

    public $deleteLoading = false;
    public function deleteItem($id)
    {
        $this->deleteLoading = true;
        CardItem::find($id)->delete();
        $this->deleteLoading = false;
    }

    public $ubahharga_show = false, $ubahharga_input, $ubahHargaID;

    public function ubahharga_toggle($id)
    {
        $this->ubahHargaID = $id;
        $cardItem = CardItem::find($id);
        $produk = ProdukItem::find($cardItem->produk_item_id);
        $this->ubahHarga_produkNama = $produk->produk->nama;
        $this->ubahHarga_harga_pokok = $produk->harga_pokok;
        $this->ubahHargaJualDasar = $produk->harga_jual;
        // dd($this->ubahHargaDiskonJual);

        if ($produk->diskon_start <= date('Y-m-d') && $produk->diskon_end >= date('Y-m-d')) {
            if ($produk->jam_start != null && $produk->jam_end != null) {
                if ($produk->jam_start <= date('H:i:s') && $produk->jam_end >= date('H:i:s')) {
                    $this->ubahHargaDiskonJual = $produk->diskon_harga_jual;
                    $this->ubahPersenDiskon = $produk->diskon_persen;
                    // dd('dd');
                } else {
                    // dd('aa');
                    $this->ubahHargaDiskonJual = null;
                    $this->ubahPersenDiskon = 0;
                }
            } else {
                // dd('cc');
                $this->ubahHargaDiskonJual = $produk->diskon_harga_jual;
                $this->ubahPersenDiskon = $produk->diskon_persen;
            }
        } else {
            // dd('qq');
            $this->ubahHargaDiskonJual = null;
            $this->ubahPersenDiskon = 0;
        }

        $this->ubahharga_show = true;

    }

    public function ubahharga_close()
    {
        $this->ubahHargaID = null;
        $this->ubahHarga_produkNama = null;
        $this->ubahHarga_harga_pokok = null;
        $this->ubahHargaJualDasar = null;
        $this->ubahHargaDiskonJual = null;
        $this->ubahPersenDiskon = null;

        $this->ubahharga_show = false;

    }

    public $ubahPersenDiskon, $ubahHarga_produkNama, $ubahHarga_harga_pokok, $ubahHargaJualDasar, $ubahHargaDiskonJual;

    public function simpanUbahHarga()
    {
        $id = $this->ubahHargaID;
        $cardItem = CardItem::find($id);
        $produk = ProdukItem::find($cardItem->produk_item_id);

        $var_harga_jual = $produk->harga_jual;

        // update produk
        if ($this->ubahHargaDiskonJual) {
            $produk->update([
                'harga_jual' => $this->ubahHargaJualDasar,
                'diskon_harga_jual' => $this->ubahHargaDiskonJual,
            ]);
        } else {
            $produk->update([
                'harga_jual' => $this->ubahHargaJualDasar,
            ]);
        }

        // riwayat harga create
        RiwayatHarga::create([
            'produk_id' => $produk->produk_id,
            'produk_item_id' => $produk->id,
            'harga_jual_awal' => $var_harga_jual ? $var_harga_jual : null,
            'harga_jual_akhir' => $this->ubahHargaJualDasar ? $this->ubahHargaJualDasar : null,
            'status' => 'telah diperbarui',
            'user_id' => auth()->user()->id,
        ]);

        // update carditem
        $qty = $cardItem->qty;
        $total_harga_modal = $produk->harga_pokok * $qty;
        $total_harga_jual = $produk->harga_jual * $qty;
        $total_potongan_diskon = ($produk->harga_jual * ($cardItem->diskon_persen / 100)) * $qty;
        $total_harga = $total_harga_jual - $total_potongan_diskon;
        $untung = $total_harga - $total_harga_modal;
        $cardItem->update([
            'harga_jual' => $produk->harga_jual,
            'qty' => $qty,
            'total_harga_modal' => $total_harga_modal,
            'total_harga_jual' => $total_harga_jual,
            'potongan_diskon' => $total_potongan_diskon,
            'total_harga' => $total_harga,
            'untung' => $untung,
        ]);

        // $this->ubahharga_close();
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
    }

    // pelanggan
    public $pelanggan_show = false, $pelanggan_take = 25;
    public $pelanggan_id, $pelanggan_nama, $pelanggan_phone, $pelanggan_piutang_usaha, $pelanggan_hutang_usaha;

    public $CariPelanggan;

    public $tambahPelangganPage = false;
    public $img, $nama, $jk, $daerah, $alamat, $phone, $email, $bank, $norek, $an;

    public function pelanggan_toggle()
    {
        if ($this->pelanggan_show == true) {
            $this->CariPelanggan = null;
            $this->diterima = 0;
            $this->kembali = 0;

            $this->pelanggan_show = false;
        } else {
            $this->CariPelanggan = null;
            $this->pelanggan_show = true;
        }
    }

    public function simpanPelanggan()
    {
        Pelanggan::create([
            'nama' => $this->nama,
            'jk' => $this->jk,
            'daerah' => $this->daerah,
            'alamat' => $this->alamat,
            'phone' => $this->phone,
            'email' => $this->email,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an,
        ]);

        $this->tambahPelangganPage = false;
        $this->emit('success', ['pesan' => 'Berhasil tambah pelanggan']);

        $this->nama = null;
        $this->jk = null;
        $this->phone = null;
        $this->daerah = null;
        $this->alamat = null;
        $this->email = null;
        $this->bank = null;
        $this->norek = null;
        $this->an = null;
    }

    public function pelanggan_lainnya()
    {
        $this->pelanggan_take += 25;
    }

    public function pelanggan_id($id)
    {
        $this->pelanggan_id = $id;
        $data = Pelanggan::find($id);
        $this->pelanggan_phone = $data->phone;
        $this->pelanggan_nama = $data->nama;
        $this->pelanggan_piutang_usaha = $data->piutang_usaha;
        $this->pelanggan_hutang_usaha = $data->hutang_usaha;

        $this->pelanggan_toggle();
    }

    public $waktu;

    public $total_potongan_diskon, $tagihan_utang, $pajak, $total_harga_jual, $total_harga_pokok, $total_harga;

    public $ongkir = 0;

    public $total_pembayaran;

    public $bayar_tunai_show = false;

    public $diterima = 0, $kembali = 0;

    public function bayar_tunai_toggle()
    {
        $this->bayar_tunai_show = true;
    }

    public function bayar_tunai_close()
    {
        $this->diterima = 0;
        $this->kembali = 0;

        $this->bayar_tunai_show = false;
    }

    public $isCetak = false;
    public function bayar_tunai_cetak_struk()
    {
        $cek = $this->bayar_tunai_query();

        if ($cek != 'error') {
            $this->emit('cetakData', ['url' => url('penjualan/struk', $cek['transaksi_id']), 'title' => 'struk']);
        }
    }
    public function bayar_tunai_cetak_nota()
    {
        $cek = $this->bayar_tunai_query();

        if ($cek != 'error') {
            $this->emit('cetakData', ['url' => url('struk'), 'title' => 'struk']);
        }
    }
    public function bayar_tunai()
    {
        $this->bayar_tunai_query();
    }
    public function bayar_tunai_query()
    {
        // validasi data
        if ($this->diterima < $this->total_pembayaran) {
            $this->emit('error', ['pesan' => 'Uang pembayaran kurang']);
            return 'error';
        } elseif ($this->total_harga == 0) {
            $this->emit('error', ['pesan' => 'Pilih produk']);
            return 'error';
        }else {

            $no_penjualan = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(0001, 9999);
            $cek_no_penjualan = Penjualan::where('no_penjualan', $no_penjualan)->first();
            if ($cek_no_penjualan != null) {
                $no_penjualan = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(0001, 9999);
            }
            $waktu = now();
            $pelanggan_id = $this->pelanggan_id != null ? $this->pelanggan_id : null;
            $kasir = Kasir::find($this->kasirID);
            $kas_id = $kasir->kas_id;

            $omset = $this->total_harga + $this->ongkir;
            $untung = $this->total_harga - $this->total_harga_pokok;

            $penjualan = Penjualan::create([
                'user_id' => auth()->user()->id,
                'kasir_id' => $this->kasirID,
                'no_penjualan' => $no_penjualan,
                'waktu' => $waktu,
                'penjualan_pesanan_id' => null,
                'pelanggan_id' => $pelanggan_id,
                'kas_id' => $kas_id,
                'total_harga_pokok' => $this->total_harga_pokok,
                'total_harga_jual' => $this->total_harga_jual,
                'potongan_diskon' => $this->total_potongan_diskon,
                'total_harga' => $this->total_harga,
                'tagihan_utang' => $this->tagihan_utang,
                'ongkir' => $this->ongkir,
                'pajak' => $this->pajak,
                'total_pembayaran' => $this->total_pembayaran,
                'diterima' => $this->diterima,
                'kembali' => $this->kembali,
                'pendapatan' => $this->total_pembayaran,
                'uang_tunai' => $this->total_pembayaran,
                'omset' => $omset,
                'untung' => $untung,
                'islunas' => true,
                'keterangan' => null,
                'status' => 'success',
            ]);

            // update kas berdasarkan jumlah pendapatan
            $kaskasir = Kas::find($kas_id);
            $kaskasir->update([
                'saldo' => $kaskasir->saldo + $this->total_harga + $this->ongkir + $this->pajak,
            ]);

            $jenis = KasTJenis::where('nama', 'masuk')->first();
            $kategori = KasTKategori::where('nama', 'penjualan')->first();
            KasTransaksi::create([
                'kas_t_jenis_id' => $jenis->id,
                'kas_t_kategori_id' => $kategori->id,
                'kas_id' => $kas_id,
                'nominal' => $this->total_harga + $this->ongkir + $this->pajak,
                'keterangan' => 'penjualan',
                'user_id' => auth()->user()->id,
            ]);

            // jika memiliki tagihan utang, buat transaksi piutang usaha
            // hutang pel dikurangi
            if ($this->tagihan_utang > 0) {
                $pel = Pelanggan::find($pelanggan_id);
                $kas = Kas::find($kas_id);
                if ($pel->piutang_usaha < $this->tagihan_utang) {
                    $this->emit('error', ['pesan' => 'Jumlah tidak boleh melebihi utang pelanggan saat ini']);
                } else {
                    $kas->update([
                        'saldo' => $kas->saldo + $this->tagihan_utang,
                    ]);
                    $jenis = KasTJenis::where('nama', 'masuk')->first();
                    $kategori = KasTKategori::where('nama', 'penagihan hutang')->first();
                    $kasT = KasTransaksi::create([
                        'kas_t_jenis_id' => $jenis->id,
                        'kas_t_kategori_id' => $kategori->id,
                        'kas_id' => $kas_id,
                        'nominal' => $this->tagihan_utang,
                        'keterangan' => 'tagih utang',
                        'user_id' => auth()->user()->id,
                    ]);

                    Piutang::create([
                        'pelanggan_id' => $pelanggan_id,
                        'jenis' => 'kurang',
                        'kas_id' => $kas_id,
                        'kas_transaksi_id' => $kasT->id,
                        'penjualan_id' => $penjualan->id,
                        'kasir_id' => $this->kasirID,
                        'jumlah' => $this->tagihan_utang,
                        'keterangan' => null,
                        'user_id' => auth()->user()->id,
                    ]);

                    $pel->update([
                        'piutang_usaha' => $pel->piutang_usaha - $this->tagihan_utang,
                    ]);
                }
            }

            // penjualan Item
            $cardItem = CardItem::where('user_id', auth()->user()->id)->get();

            foreach ($cardItem as $item) {
                $penjualanItem = PenjualanItem::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $item->produk_id,
                    'merek_id' => $item->merek_id,
                    'catalog_id' => $item->catalog_id,
                    'kategori_id' => $item->kategori_id,
                    'rak_id' => $item->rak_id,
                    'produk_item_id' => $item->produk_item_id,
                    'satuan_id' => $item->satuan_id,
                    'harga_modal' => $item->harga_modal,
                    'harga_jual' => $item->harga_jual,
                    'qty' => $item->qty,
                    'total_harga_modal' => $item->total_harga_modal,
                    'total_harga_jual' => $item->total_harga_jual,
                    'diskon_persen' => $item->diskon_persen,
                    'potongan_diskon' => $item->potongan_diskon,
                    'total_harga' => $item->total_harga,
                    'untung' => $item->untung,
                ]);

                // KELOLA STOK
                // kurangi stok pada produkItem
                $produkitem = ProdukItem::find($item->produk_item_id);
                $produk = Produk::find($produkitem->produk->id);

                $jenis = StokJenis::where('nama', 'keluar')->first();
                $stok_kategori = StokKategori::where('nama', 'penjualan')->first();

                if ($produk->tipe == 'INV') {
                    $min = $produk->produk_item->min('konversi');
                    $max = $produk->produk_item->max('konversi');

                    // perubahan stok
                    foreach ($produk->produk_item as $data) {
                        $dasar = $produk->produk_item->where('konversi', $min)->first();
                        $konversiDasar = $data->find($item->produk_item_id);
                        $hasil = $item->qty * $konversiDasar->konversi;

                        if ($data->id == $item->produk_item_id) {

                            $st = StokTransaksi::create([
                                'produk_id' => $produkitem->produk->id,
                                'produk_item_id' => $data->id,
                                'stok_jenis_id' => $jenis->id,
                                'stok_kategori_id' => $stok_kategori->id,
                                'jumlah' => $hasil,
                                'catatan' => null,
                                'user_id' => auth()->user()->id,
                            ]);
                        }

                        if ($data->id == $dasar->id) {
                            $data->update([
                                'stok_jual' => $data->stok_jual - $hasil,
                                'stok_buku' => $data->stok_buku - $hasil,
                            ]);
                        } else {
                            $data->update([
                                'stok_jual' => $dasar->stok_jual / $data->konversi,
                                'stok_buku' => $dasar->stok_buku / $data->konversi,
                            ]);
                        }
                    }
                } elseif ($produk->tipe == 'rakitan') {
                    $produkitem->update([
                        'stok_jual' => $produkitem->stok_jual - $item->qty,
                        'stok_buku' => $produkitem->stok_buku - $item->qty,
                    ]);
                    $jenis = StokJenis::where('nama', 'keluar')->first();
                    $st = StokTransaksi::create([
                        'produk_id' => $produkitem->produk->id,
                        'produk_item_id' => $produkitem->id,
                        'stok_jenis_id' => $jenis->id,
                        'stok_kategori_id' => $stok_kategori->id,
                        'jumlah' => $item->qty,
                        'catatan' => null,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }

            $this->pelanggan_id = null;
            $this->pelanggan_phone = null;
            $this->pelanggan_nama = null;
            $this->pelanggan_piutang_usaha = null;
            $this->pelanggan_hutang_usaha = null;
            $this->ongkir = 0;
            foreach ($cardItem as $item) {
                $item->delete();
            }

            redirect()->to('penjualan/kasir/' . $this->kasirID);
            // $this->bayar_tunai_close();
            return ['transaksi_id' => $penjualan->no_penjualan];
        }

    }

    public function bayar_nontunai_toggle()
    {

    }

    public function resetKasir()
    {

        $this->pelanggan_id = null;
        $this->pelanggan_phone = null;
        $this->pelanggan_nama = null;
        $this->pelanggan_piutang_usaha = null;
        $this->pelanggan_hutang_usaha = null;
        $this->ongkir = 0;

        // delete CardItem by user_id
        $cardItem = CardItem::where('user_id', auth()->user()->id)->get();
        foreach ($cardItem as $data) {
            $data->delete();
        }

    }
}
