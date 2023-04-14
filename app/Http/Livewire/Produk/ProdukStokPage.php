<?php

namespace App\Http\Livewire\Produk;

use App\Models\Produk;
use App\Models\ProdukItem;
use App\Models\RiwayatHarga;
use App\Models\StokJenis;
use App\Models\StokKategori;
use App\Models\StokOpname;
use App\Models\StokTransaksi;
use Livewire\Component;

class ProdukStokPage extends Component
{
    public $tambahPage = false, $editPage = false;

    public $produkItems = [];

    public $produkNama;

    public $takeProdukitem = 20;

    public $masuk_show = false;
    public $masukID;
    public $satuanNama, $namaProduk, $stokBeli, $stokBuku, $harga_pokok, $harga_jual;

    public $stok_kategori_id, $perlu_ubah_harga = false, $jumlahstok, $catatan, $harga_pokok_akhir, $harga_jual_akhir;

    public $keluar_show = false;
    public $keluarID;

    public $revisi_show = false;
    public $revisiID;

    public $opnameID, $opname_stok_fisik;

    public function render()
    {
        $produk = ProdukItem::with('produk')->take($this->takeProdukitem);
        if ($this->produkNama) {
            $produk->whereRelation('produk', 'nama', 'like', '%' . $this->produkNama . '%');
        }
        $produk->whereRelation('produk', 'tipe', 'INV');
        $produk->orWhereRelation('produk', 'tipe', 'rakitan');
        $this->produkItems = $produk->orderBy('produk_id', 'ASC')->orderBy('konversi', 'ASC')->get();

        return view('livewire.produk.produk-stok-page')->extends('layouts.app')->section('content');
    }

    public function resetDataMasuk()
    {
        $this->masukID = null;
        $this->namaProduk = null;
        $this->stokBeli = null;
        $this->stokBuku = null;
        $this->harga_pokok = null;
        $this->harga_jual = null;

        $this->stok_kategori_id = null;
        $this->harga_pokok_akhir = null;
        $this->harga_jual_akhir = null;
        $this->jumlahstok = null;
        $this->catatan = null;
        $this->perlu_ubah_harga = null;

    }

    public function masuk_toggle($id)
    {
        if ($this->masuk_show == false) {
            $this->masukID = $id;
            $produk = ProdukItem::find($id);
            $this->namaProduk = $produk->produk->nama;
            $this->stokBeli = $produk->stok_beli;
            $this->stokBuku = $produk->stok_buku;
            $this->satuanNama = $produk->satuan->satuan;
            $this->harga_pokok = $produk->harga_beli;
            $this->harga_jual = $produk->harga_jual;

            $jenis = StokJenis::where('nama', 'masuk')->first();
            $this->stok_kategori = StokKategori::where('stok_jenis_id', $jenis->id)->get();

            $this->masuk_show = true;
        } else {
            $this->resetDataMasuk();
            $this->masuk_show = false;
        }
    }
    public function masukTutup()
    {
        $this->resetDataMasuk();
        $this->masuk_show = false;
    }

    public function simpanMasuk()
    {
        $var_masukID = $this->masukID;
        $var_jumlahstok = $this->jumlahstok;
        $bool_ubah_harga = $this->perlu_ubah_harga;
        $var_harga_jual = $this->harga_jual;
        $var_harga_jual_akhir = $this->harga_jual_akhir;
        $var_harga_pokok = $this->harga_pokok;
        $var_harga_pokok_akhir = $this->harga_pokok_akhir;

        $var_stok_kategori_id = $this->stok_kategori_id;
        $var_catatan = $this->catatan;

        // STOK MASUK

        $produkitem = ProdukItem::find($var_masukID);

        $produk = Produk::find($produkitem->produk->id);

        if ($produk->tipe == 'INV') {
            $min = $produk->produk_item->min('konversi');
            $max = $produk->produk_item->max('konversi');

            foreach ($produk->produk_item as $data) {
                $dasar = $produk->produk_item->where('konversi', $min)->first();
                $konversiDasar = $data->find($var_masukID);
                $hasil = $var_jumlahstok * $konversiDasar->konversi;

                if ($data->id == $var_masukID) {
                    $jenis = StokJenis::where('nama', 'masuk')->first();
                    $st = StokTransaksi::create([
                        'produk_id' => $produkitem->produk->id,
                        'produk_item_id' => $data->id,
                        'stok_jenis_id' => $jenis->id,
                        'stok_kategori_id' => $var_stok_kategori_id,
                        'jumlah' => $var_jumlahstok,
                        'catatan' => $this->catatan,
                        'user_id' => auth()->user()->id,
                    ]);
                }

                if ($data->id == $dasar->id) {
                    $data->update([
                        'stok_jual' => $data->stok_jual + $hasil,
                        'stok_buku' => $data->stok_buku + $hasil,
                    ]);
                } else {
                    $data->update([
                        'stok_jual' => $dasar->stok_jual / $data->konversi,
                        'stok_buku' => $dasar->stok_buku / $data->konversi,
                    ]);
                }
            }

            if ($bool_ubah_harga) {
                RiwayatHarga::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_transaksi_id' => $st->id,
                    'harga_jual_awal' => $var_harga_jual ? $var_harga_jual : null,
                    'harga_jual_akhir' => $var_harga_jual_akhir ? $var_harga_jual_akhir : null,
                    'harga_beli_awal' => $var_harga_pokok ? $var_harga_pokok : null,
                    'harga_beli_akhir' => $var_harga_pokok_akhir ? $var_harga_pokok_akhir : null,
                    'status' => 'perlu diperbarui',
                    'user_id' => auth()->user()->id,
                ]);
            }

            $this->resetDataMasuk();
            $this->masuk_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        } elseif ($produk->tipe == 'rakitan') {
            $produkitem->update([
                'stok_jual' => $produkitem->stok_jual + $var_jumlahstok,
                'stok_buku' => $produkitem->stok_buku + $var_jumlahstok,
            ]);

            $jenis = StokJenis::where('nama', 'masuk')->first();
            $st = StokTransaksi::create([
                'produk_id' => $produkitem->produk->id,
                'produk_item_id' => $produkitem->id,
                'stok_jenis_id' => $jenis->id,
                'stok_kategori_id' => $var_stok_kategori_id,
                'jumlah' => $var_jumlahstok,
                'catatan' => $var_catatan,
                'user_id' => auth()->user()->id,
            ]);
            if ($this->perlu_ubah_harga) {
                RiwayatHarga::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_transaksi_id' => $st->id,
                    'harga_jual_awal' => $var_harga_jual ? $var_harga_jual : null,
                    'harga_jual_akhir' => $var_harga_jual_akhir ? $var_harga_jual_akhir : null,
                    'harga_beli_awal' => $var_harga_pokok ? $var_harga_pokok : null,
                    'harga_beli_akhir' => $var_harga_pokok_akhir ? $var_harga_pokok_akhir : null,
                    'status' => 'perlu diperbarui',
                    'user_id' => auth()->user()->id,
                ]);
            }
            $this->resetDataMasuk();
            $this->masuk_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        }
    }

    public function keluar_toggle($id)
    {
        if ($this->keluar_show == false) {
            $this->keluarID = $id;
            $produk = ProdukItem::find($id);
            $this->namaProduk = $produk->produk->nama;
            $this->stokBeli = $produk->stok_beli;
            $this->stokBuku = $produk->stok_buku;
            $this->satuanNama = $produk->satuan->satuan;
            $this->harga_pokok = $produk->harga_pokok;
            $this->harga_jual = $produk->harga_jual;

            $jenis = StokJenis::where('nama', 'keluar')->first();
            $this->stok_kategori = StokKategori::where('stok_jenis_id', $jenis->id)->get();

            $this->keluar_show = true;
        } else {
            $this->resetDataMasuk();
            $this->keluar_show = false;
        }
    }

    public function keluarTutup()
    {
        $this->resetDataMasuk();
        $this->keluar_show = false;
    }

    public function simpanKeluar()
    {
        $produkitem = ProdukItem::find($this->keluarID);

        $produk = Produk::find($produkitem->produk->id);

        if ($produk->tipe == 'INV') {
            $min = $produk->produk_item->min('konversi');
            $max = $produk->produk_item->max('konversi');

            // perubahan stok
            foreach ($produk->produk_item as $data) {
                $dasar = $produk->produk_item->where('konversi', $min)->first();
                $konversiDasar = $data->find($this->keluarID);
                $hasil = $this->jumlahstok * $konversiDasar->konversi;

                if ($data->id == $this->keluarID) {
                    $jenis = StokJenis::where('nama', 'keluar')->first();
                    $st = StokTransaksi::create([
                        'produk_id' => $produkitem->produk->id,
                        'produk_item_id' => $data->id,
                        'stok_jenis_id' => $jenis->id,
                        'stok_kategori_id' => $this->stok_kategori_id,
                        'jumlah' => $hasil,
                        'catatan' => $this->catatan,
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

            $this->resetDataMasuk();
            $this->keluar_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        } elseif ($produk->tipe == 'rakitan') {
            $produkitem->update([
                'stok_jual' => $produkitem->stok_jual - $this->jumlahstok,
                'stok_buku' => $produkitem->stok_buku - $this->jumlahstok,
            ]);
            $jenis = StokJenis::where('nama', 'keluar')->first();
            $st = StokTransaksi::create([
                'produk_id' => $produkitem->produk->id,
                'produk_item_id' => $produkitem->id,
                'stok_jenis_id' => $jenis->id,
                'stok_kategori_id' => $this->stok_kategori_id,
                'jumlah' => $this->jumlahstok,
                'catatan' => $this->catatan,
                'user_id' => auth()->user()->id,
            ]);
            $this->resetDataMasuk();
            $this->keluar_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        }
    }

    public function revisi_toggle($id)
    {
        if ($this->revisi_show == false) {
            $this->revisiID = $id;
            $produk = ProdukItem::find($id);
            $this->namaProduk = $produk->produk->nama;
            $this->stokBeli = $produk->stok_beli;
            $this->stokBuku = $produk->stok_buku;
            $this->satuanNama = $produk->satuan->satuan;
            $this->harga_pokok = $produk->harga_pokok;
            $this->harga_jual = $produk->harga_jual;

            $this->stok_kategori_id = StokKategori::where('nama', 'revisi')->first()->id;

            $this->revisi_show = true;
        } else {
            $this->resetDataMasuk();
            $this->revisi_show = false;
        }
    }

    public function revisiTutup()
    {
        $this->resetDataMasuk();
        $this->revisi_show = false;
    }

    public function simpanRevisi()
    {
        $produkitem = ProdukItem::find($this->revisiID);

        $produk = Produk::find($produkitem->produk->id);

        if ($produk->tipe == 'INV') {
            $min = $produk->produk_item->min('konversi');
            $max = $produk->produk_item->max('konversi');

            foreach ($produk->produk_item as $data) {
                $dasar = $produk->produk_item->where('konversi', $min)->first();
                $konversiDasar = $data->find($this->revisiID);
                $hasil = $this->jumlahstok * $konversiDasar->konversi;

                if ($hasil > $data->stok_buku) {
                    $sisa_stok_jual = $hasil - $data->stok_jual;
                    $sisa_stok_buku = $hasil - $data->stok_buku;

                    if ($data->id == $this->revisiID) {
                        $jenis = StokJenis::where('nama', 'masuk')->first();
                        StokTransaksi::create([
                            'produk_id' => $produkitem->produk->id,
                            'produk_item_id' => $data->id,
                            'stok_jenis_id' => $jenis->id,
                            'stok_kategori_id' => $this->stok_kategori_id,
                            'jumlah' => $sisa_stok_buku,
                            'catatan' => $this->catatan,
                            'user_id' => auth()->user()->id,
                        ]);
                    }

                    if ($data->id == $dasar->id) {
                        $data->update([
                            'stok_jual' => $data->stok_jual + $sisa_stok_jual,
                            'stok_buku' => $data->stok_buku + $sisa_stok_buku,
                        ]);
                    } else {
                        $data->update([
                            'stok_jual' => $dasar->stok_jual / $data->konversi,
                            'stok_buku' => $dasar->stok_buku / $data->konversi,
                        ]);
                    }
                } elseif ($hasil < $data->stok_buku) {
                    $sisa_stok_jual = $data->stok_jual - $hasil;
                    $sisa_stok_buku = $data->stok_buku - $hasil;

                    if ($data->id == $this->revisiID) {
                        $jenis = StokJenis::where('nama', 'keluar')->first();
                        StokTransaksi::create([
                            'produk_id' => $produkitem->produk->id,
                            'produk_item_id' => $data->id,
                            'stok_jenis_id' => $jenis->id,
                            'stok_kategori_id' => $this->stok_kategori_id,
                            'jumlah' => $sisa_stok_buku,
                            'catatan' => $this->catatan,
                            'user_id' => auth()->user()->id,
                        ]);
                    }

                    if ($data->id == $dasar->id) {
                        $data->update([
                            'stok_jual' => $data->stok_jual - $sisa_stok_jual,
                            'stok_buku' => $data->stok_buku - $sisa_stok_buku,
                        ]);

                    } else {
                        $data->update([
                            'stok_jual' => $dasar->stok_jual / $data->konversi,
                            'stok_buku' => $dasar->stok_buku / $data->konversi,
                        ]);
                    }
                }

            }

            $this->resetDataMasuk();
            $this->revisi_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        } elseif ($produk->tipe == 'rakitan') {
            if ($produkitem->stok_buku > $this->jumlahstok) {
                $sisa_stok_jual = $produkitem->stok_jual - $this->jumlahstok;
                $sisa_stok_buku = $produkitem->stok_buku - $this->jumlahstok;

                $produkitem->update([
                    'stok_jual' => $produkitem->stok_jual - $sisa_stok_jual,
                    'stok_buku' => $produkitem->stok_buku - $sisa_stok_buku,
                ]);
                $jenis = StokJenis::where('nama', 'keluar')->first();
                StokTransaksi::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_jenis_id' => $jenis->id,
                    'stok_kategori_id' => $this->stok_kategori_id,
                    'jumlah' => $this->jumlahstok,
                    'catatan' => $this->catatan,
                    'user_id' => auth()->user()->id,
                ]);
            } elseif ($produkitem->stok_buku < $this->jumlahstok) {
                $sisa_stok_jual =  $this->jumlahstok - $produkitem->stok_jual;
                $sisa_stok_buku = $this->jumlahstok - $produkitem->stok_buku;

                $produkitem->update([
                    'stok_jual' => $produkitem->stok_jual + $sisa_stok_jual,
                    'stok_buku' => $produkitem->stok_buku + $sisa_stok_buku,
                ]);
                $jenis = StokJenis::where('nama', 'masuk')->first();
                StokTransaksi::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_jenis_id' => $jenis->id,
                    'stok_kategori_id' => $this->stok_kategori_id,
                    'jumlah' => $this->jumlahstok,
                    'catatan' => $this->catatan,
                    'user_id' => auth()->user()->id,
                ]);
            }

            $this->resetDataMasuk();
            $this->revisi_show = false;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        }
    }

    public function opnameShow($id)
    {
        $this->opname_stok_fisik = null;

        $this->opnameID = $id;
    }

    public function simpanOpname($id)
    {
        $produkitem = ProdukItem::find($id);

        $produk = Produk::find($produkitem->produk->id);
        $stok_kategori_id = StokKategori::where('nama', 'opname')->first()->id;

        if ($produk->tipe == 'INV') {
            $min = $produk->produk_item->min('konversi');
            $max = $produk->produk_item->max('konversi');

            foreach ($produk->produk_item as $data) {
                $dasar = $produk->produk_item->where('konversi', $min)->first();
                $konversiDasar = $data->find($id);
                $hasil = $this->opname_stok_fisik * $konversiDasar->konversi;

                if ($hasil > $data->stok_buku) {
                    $sisa_stok_jual = $hasil - $data->stok_jual;
                    $sisa_stok_buku = $hasil - $data->stok_buku;

                    if ($data->id == $id) {
                        $jenis = StokJenis::where('nama', 'masuk')->first();
                        StokTransaksi::create([
                            'produk_id' => $produkitem->produk->id,
                            'produk_item_id' => $id,
                            'stok_jenis_id' => $jenis->id,
                            'stok_kategori_id' => $stok_kategori_id,
                            'jumlah' => $sisa_stok_buku,
                            'catatan' => $this->catatan,
                            'user_id' => auth()->user()->id,
                        ]);
                        $harga_produk = $data->harga_jual;
                        $stok_selisih = $this->opname_stok_fisik - $data->stok_buku;
                        StokOpname::create([
                            'produk_item_id' => $id,
                            'stok_buku' => $data->stok_buku,
                            'stok_fisik' => $this->opname_stok_fisik,
                            'stok_selisih' => $stok_selisih,
                            'selisih_harga_produk' => $harga_produk,
                            'selisih_total_harga_produk' => $harga_produk * $stok_selisih,
                            'user_id' => auth()->user()->id,
                        ]);
                    }
                    if ($data->id == $dasar->id) {
                        $data->update([
                            'stok_jual' => $data->stok_jual + $sisa_stok_jual,
                            'stok_buku' => $data->stok_buku + $sisa_stok_buku,
                            'opname_at' => now()
                        ]);
                    } else {
                        $data->update([
                            'stok_jual' => $dasar->stok_jual / $data->konversi,
                            'stok_buku' => $dasar->stok_buku / $data->konversi,
                            'opname_at' => now()
                        ]);
                    }

                } elseif ($hasil < $data->stok_buku) {
                    $sisa_stok_jual = $data->stok_jual - $hasil;
                    $sisa_stok_buku = $data->stok_buku - $hasil;

                    if ($data->id == $id) {
                        $jenis = StokJenis::where('nama', 'keluar')->first();
                        StokTransaksi::create([
                            'produk_id' => $produkitem->produk->id,
                            'produk_item_id' => $data->id,
                            'stok_jenis_id' => $jenis->id,
                            'stok_kategori_id' => $stok_kategori_id,
                            'jumlah' => $sisa_stok_buku,
                            'catatan' => $this->catatan,
                            'user_id' => auth()->user()->id,
                        ]);
                        $harga_produk = $data->harga_jual;
                        $stok_selisih = $this->opname_stok_fisik - $data->stok_buku;
                        StokOpname::create([
                            'produk_item_id' => $id,
                            'stok_buku' => $data->stok_buku,
                            'stok_fisik' => $this->opname_stok_fisik,
                            'stok_selisih' => $stok_selisih,
                            'selisih_harga_produk' => $harga_produk,
                            'selisih_total_harga_produk' => $harga_produk * $stok_selisih,
                            'user_id' => auth()->user()->id,
                        ]);
                    }
                    if ($data->id == $dasar->id) {
                        $data->update([
                            'stok_jual' => $data->stok_jual - $sisa_stok_jual,
                            'stok_buku' => $data->stok_buku - $sisa_stok_buku,
                            'opname_at' => now()
                        ]);
                    } else {
                        $data->update([
                            'stok_jual' => $dasar->stok_jual / $data->konversi,
                            'stok_buku' => $dasar->stok_buku / $data->konversi,
                            'opname_at' => now()
                        ]);
                    }

                }

            }

            $this->opname_stok_fisik = null;
            $this->opnameID = null;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        } elseif ($produk->tipe == 'rakitan') {
            if ($produkitem->stok_buku > $this->opname_stok_fisik) {
                $sisa_stok_jual = $produkitem->stok_jual - $this->opname_stok_fisik;
                $sisa_stok_buku = $produkitem->stok_buku - $this->opname_stok_fisik;

                $produkitem->update([
                    'stok_jual' => $produkitem->stok_jual - $sisa_stok_jual,
                    'stok_buku' => $produkitem->stok_buku - $sisa_stok_buku,
                    'opname_at' => now()
                ]);
                $jenis = StokJenis::where('nama', 'keluar')->first();
                StokTransaksi::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_jenis_id' => $jenis->id,
                    'stok_kategori_id' => $stok_kategori_id,
                    'jumlah' => $sisa_stok_buku,
                    'catatan' => $this->catatan,
                    'user_id' => auth()->user()->id,
                ]);
                $harga_produk = $produkitem->harga_jual;
                $stok_selisih = $this->opname_stok_fisik - $produkitem->stok_buku;
                StokOpname::create([
                    'produk_item_id' => $id,
                    'stok_buku' => $produkitem->stok_buku,
                    'stok_fisik' => $this->opname_stok_fisik,
                    'stok_selisih' => $stok_selisih,
                    'selisih_harga_produk' => $harga_produk,
                    'selisih_total_harga_produk' => $harga_produk * $stok_selisih,
                    'user_id' => auth()->user()->id,
                ]);
            } elseif ($produkitem->stok_buku < $this->opname_stok_fisik) {
                $sisa_stok_jual =  $this->opname_stok_fisik - $produkitem->stok_jual;
                $sisa_stok_buku = $this->opname_stok_fisik - $produkitem->stok_buku;

                $produkitem->update([
                    'stok_jual' => $produkitem->stok_jual + $sisa_stok_jual,
                    'stok_buku' => $produkitem->stok_buku + $sisa_stok_buku,
                    'opname_at' => now()
                ]);
                $jenis = StokJenis::where('nama', 'masuk')->first();
                StokTransaksi::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_jenis_id' => $jenis->id,
                    'stok_kategori_id' => $stok_kategori_id,
                    'jumlah' => $sisa_stok_buku,
                    'catatan' => $this->catatan,
                    'user_id' => auth()->user()->id,
                ]);
                $harga_produk = $produkitem->harga_jual;
                $stok_selisih = $this->opname_stok_fisik - $produkitem->stok_buku;
                StokOpname::create([
                    'produk_item_id' => $id,
                    'stok_buku' => $produkitem->stok_buku,
                    'stok_fisik' => $this->opname_stok_fisik,
                    'stok_selisih' => $stok_selisih,
                    'selisih_harga_produk' => $harga_produk,
                    'selisih_total_harga_produk' => $harga_produk * $stok_selisih,
                    'user_id' => auth()->user()->id,
                ]);
            }

            $this->opname_stok_fisik = null;
            $this->opnameID = null;
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        }

    }

}
