<?php

namespace App\Http\Livewire\Hutang;

use App\Models\Hutang;
use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Supplier;
use Livewire\Component;

class HutangSupplierPage extends Component
{
    public $total_hutang_supplier;

    public $jml_orang;

    public $takeSupplier = 20;
    public $cariNama;

    public $tambahPage = false, $kurangPage = false;

    public $d_id, $d_nama, $d_hutang, $d_titip_uang_usaha, $d_kas_id, $d_jumlah, $d_keterangan;

    public $bayar_sisa_hutang_usaha;

    public function render()
    {
        $supplier = Supplier::take($this->takeSupplier)->orderBy('hutang_usaha', 'desc');
        if ($this->cariNama) {
            $supplier->where('nama', 'like', '%' . $this->cariNama . '%');
        }
        $this->supplier = $supplier->get();

        $this->jml_orang = Supplier::where('hutang_usaha', '>', 0)->get()->count();
        $this->total_hutang_supplier = Supplier::get()->sum('hutang_usaha');

        if ($this->bayar_sisa_hutang_usaha) {
            $this->bayar_sisa_hutang_usaha = $this->bayar_sisa_hutang_usaha;
        } else {
            $this->bayar_sisa_hutang_usaha = 0;
        }

        $this->kas = Kas::where('isaktif', true)->get();
        return view('livewire.hutang.hutang-supplier-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->d_id = null;
        $this->d_nama = null;
        $this->d_hutang = null;
        $this->d_titip_uang_usaha = null;
        $this->d_kas_id = null;
        $this->d_jumlah = null;
        $this->d_keterangan = null;
    }

    public function tambahPage($id)
    {
        $d = Supplier::find($id);
        $this->d_id = $id;
        $this->d_nama = $d->nama;
        $this->d_hutang = $d->hutang_usaha;

        $this->tambahPage = true;
    }

    public function tambah()
    {
        try {
            $kas = Kas::find($this->d_kas_id);
            $kas->update([
                'saldo' => $kas->saldo + $this->d_jumlah,
            ]);
            $jenis = KasTJenis::where('nama', 'masuk')->first();
            $kategori = KasTKategori::where('nama', 'terima pinjaman')->first();
            $kasT = KasTransaksi::create([
                'kas_t_jenis_id' => $jenis->id,
                'kas_t_kategori_id' => $kategori->id,
                'kas_id' => $this->d_kas_id,
                'nominal' => $this->d_jumlah,
                'keterangan' => 'terima pinjaman dari' . $this->d_nama,
                'user_id' => auth()->user()->id,
            ]);

            Hutang::create([
                'supplier_id' => $this->d_id,
                'jenis' => 'tambah',
                'kas_id' => $this->d_kas_id,
                'kas_transaksi_id' => $kasT->id,
                'jumlah' => $this->d_jumlah,
                'keterangan' => $this->d_keterangan,
                'user_id' => auth()->user()->id,
            ]);
            $pel = Supplier::find($this->d_id);
            $pel->update([
                'hutang_usaha' => $pel->hutang_usaha + $this->d_jumlah,
            ]);

        } catch (\Throwable$e) {
            dd($e->getMessage());
        } finally {
            $this->resetData();
            $this->emit('success', ['pesan' => 'Berhasil tambah hutang']);
            $this->tambahPage = false;
        }

    }

    public function batalTambah()
    {
        $this->resetData();
        $this->tambahPage = false;
    }

    public function kurangPage($id)
    {
        $d = Supplier::find($id);
        $this->d_id = $id;
        $this->d_nama = $d->nama;
        $this->d_hutang = $d->hutang_usaha;
        $this->d_titip_uang_usaha = $d->titip_uang_usaha;

        if ($this->d_hutang < $this->d_titip_uang_usaha) {
            $this->bayar_sisa_hutang_usaha = 0;
        } else {
            $this->bayar_sisa_hutang_usaha = $this->d_hutang - $this->d_titip_uang_usaha;
        }

        // $this->bayar_sisa_hutang_usaha = 325325;

        $this->kurangPage = true;
    }
public $runKurang = false;
    public function kurang()
    {
        try {
            $pel = Supplier::find($this->d_id);
            $kas = Kas::find($this->d_kas_id);
            if($this->bayar_sisa_hutang_usaha > 0){
                if ($kas->saldo < $this->d_jumlah) {
                    $this->emit('error', ['pesan' => 'Kas tidak cukup untuk bayar hutang']);
                } elseif ($kas->saldo == 0) {
                    $this->emit('error', ['pesan' => 'Kas tidak boleh 0']);
                } else {
                    $this->runKurang = true;
                    // }else{
                    //     $this->emit('error', ['pesan' => 'Jumlah tidak boleh melebihi sisa hutang saat ini']);
                    // }
                }
            }else{
               if($this->d_hutang == 0){
                $this->emit('error', ['pesan' => 'tidak memiliki hutang']);
               }else{
                 $this->runKurang = true;
               }
            }


            if($this->runKurang == true) {
                // cek jumlah tidak boleh lebih dari sisa hutang
                // if($this->bayar_sisa_hutang_usaha ){
                    if ($this->d_titip_uang_usaha == 0) {
                        // jumlah pembayaran tidak boleh 0
                        if ($this->d_jumlah <= 0) {
                            $this->emit('error', ['pesan' => 'jumlah tidak boleh 0']);
                            $jalankan = false;
                        } else {
                            $jalankan = true;
                        }
                    } else {
                        // jumlah pembayaran boleh 0
                        $jalankan = true;
                    }

                    if ($jalankan) {
                        // kurangi hutang usaha
                        if ($this->d_titip_uang_usaha < $this->d_hutang) {

                            // hutang lebih besar dari titipan
                            // kurangi hutang dari titpan + jml
                            $pel->update([
                                'hutang_usaha' => $pel->hutang_usaha - ($this->d_titip_uang_usaha + $this->d_jumlah),
                            ]);

                            if ($this->d_jumlah > 0) {
                                $jenis = KasTJenis::where('nama', 'keluar')->first();
                                $kategori = KasTKategori::where('nama', 'pembayaran hutang usaha')->first();
                                $kasT = KasTransaksi::create([
                                    'kas_t_jenis_id' => $jenis->id,
                                    'kas_t_kategori_id' => $kategori->id,
                                    'kas_id' => $this->d_kas_id,
                                    'nominal' => $this->d_jumlah,
                                    'keterangan' => 'bayar hutang ke' . $this->d_nama,
                                    'user_id' => auth()->user()->id,
                                ]);

                                $kas->update([
                                    'saldo' => $kas->saldo - $this->d_jumlah,
                                ]);

                            }else{
                                $kasT = null;
                            }

                            Hutang::create([
                                'supplier_id' => $this->d_id,
                                'jenis' => 'kurang',
                                'kas_id' => $this->d_kas_id,
                                'kas_transaksi_id' => $kasT != null ? $kasT->id : null,
                                'jumlah' => $this->d_titip_uang_usaha + $this->d_jumlah,
                                'keterangan' => $this->d_keterangan,
                                'user_id' => auth()->user()->id,
                            ]);


                        } else if($this->d_titip_uang_usaha == $this->d_hutang || $this->d_titip_uang_usaha > $this->d_hutang) {
  // titipan lebih besar dari hutang

                            // kurangi hutang
                            $pel->update([
                                'hutang_usaha' => $pel->hutang_usaha - $this->d_hutang,
                            ]);
                            // kurangi titipan
                            $pel->update([
                                'titip_uang_usaha' => $pel->titip_uang_usaha - $this->d_hutang,
                            ]);

                        }



                        $this->resetData();
                        $this->emit('success', ['pesan' => 'Berhasil bayar hutang']);
                        $this->kurangPage = false;
                        $this->runKurang = false;

                    }
            }

        } catch (\Exception$e) {
            dd($e->getMessage());
        } finally {

        }

    }

    public function batalKurang()
    {
        $this->resetData();
        $this->kurangPage = false;
    }
}
