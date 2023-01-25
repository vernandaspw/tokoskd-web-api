<?php

namespace App\Http\Livewire\Piutang;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Pelanggan;
use App\Models\Piutang;
use Livewire\Component;

class PiutangPelangganPage extends Component
{
    public $total_piutang_pelanggan, $total_piutang_supplier;

    public $jml_orang;

    public $takePelanggan = 20;
    public $cariNama;

    public $tambahPage = false, $kurangPage = false;

    public $d_id, $d_nama, $d_piutang, $d_kas_id, $d_jumlah, $d_keterangan;

    public function render()
    {
        $pelanggan = Pelanggan::take($this->takePelanggan)->orderBy('piutang_usaha', 'desc');
        if ($this->cariNama) {
            $pelanggan->where('nama', 'like', '%' . $this->cariNama . '%');
        }
        $this->pelanggan = $pelanggan->get();

        $this->jml_orang = Pelanggan::where('piutang_usaha', '>', 0)->get()->count();
        $this->total_piutang_pelanggan = Pelanggan::get()->sum('piutang_usaha');

        $this->kas = Kas::where('isaktif', true)->get();

        return view('livewire.piutang.piutang-pelanggan-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->d_id = null;
        $this->d_nama = null;
        $this->d_piutang = null;
        $this->d_kas_id = null;
        $this->d_jumlah = null;
        $this->d_keterangan = null;
    }

    public function tambahPage($id)
    {
        $d = Pelanggan::find($id);
        $this->d_id = $id;
        $this->d_nama = $d->nama;
        $this->d_piutang = $d->piutang_usaha;

        $this->tambahPage = true;
    }

    public function tambah()
    {
        // beri hutang ke pelanggan
        // cek saldo kas jika 0 tidak bisa utang
        try {
            $kas = Kas::find($this->d_kas_id);
            if ($kas->saldo < $this->d_jumlah) {
                $this->emit('error', ['pesan' => 'Kas tidak cukup untuk memberi hutang']);
            } elseif ($kas->saldo == 0 || $this->d_jumlah == 0) {
                $this->emit('error', ['pesan' => 'Kas atau jumlah tidak boleh 0']);
            } else {
                $kas->update([
                    'saldo' => $kas->saldo - $this->d_jumlah,
                ]);
                $jenis = KasTJenis::where('nama', 'keluar')->first();
                $kategori = KasTKategori::where('nama', 'pemberian hutang')->first();
                $kasT = KasTransaksi::create([
                    'kas_t_jenis_id' => $jenis->id,
                    'kas_t_kategori_id' => $kategori->id,
                    'kas_id' => $this->d_kas_id,
                    'nominal' => $this->d_jumlah,
                    'keterangan' => 'beri hutang ' . $this->d_nama,
                    'user_id' => auth()->user()->id,
                ]);

                Piutang::create([
                    'pelanggan_id' => $this->d_id,
                    'jenis' => 'tambah',
                    'kas_id' => $this->d_kas_id,
                    'kas_transaksi_id' => $kasT->id,
                    'jumlah' => $this->d_jumlah,
                    'keterangan' => $this->d_keterangan,
                    'user_id' => auth()->user()->id,
                ]);
                $pel = Pelanggan::find($this->d_id);
                $pel->update([
                    'piutang_usaha' => $pel->piutang_usaha + $this->d_jumlah,
                ]);

                $this->resetData();
                $this->emit('success', ['pesan' => 'Berhasil tambah piutang']);
                $this->tambahPage = false;

            }
        } catch (\Throwable$e) {
            dd($e);
        }

    }

    public function batalTambah()
    {
        $this->resetData();
        $this->tambahPage = false;
    }

    public function kurangPage($id)
    {
        $d = Pelanggan::find($id);
        $this->d_id = $id;
        $this->d_nama = $d->nama;
        $this->d_piutang = $d->piutang_usaha;

        $this->kurangPage = true;
    }

    public function kurang()
    {
        try {
            $pel = Pelanggan::find($this->d_id);
            $kas = Kas::find($this->d_kas_id);
            if ($this->d_jumlah == 0) {
                $this->emit('error', ['pesan' => 'atau jumlah tidak boleh 0']);
            } elseif ($pel->piutang_usaha < $this->d_jumlah) {
                $this->emit('error', ['pesan' => 'Jumlah tidak boleh melebihi piutang saat ini']);
            } else {
                $kas->update([
                    'saldo' => $kas->saldo + $this->d_jumlah,
                ]);
                $jenis = KasTJenis::where('nama', 'masuk')->first();
                $kategori = KasTKategori::where('nama', 'penagihan hutang')->first();
                $kasT = KasTransaksi::create([
                    'kas_t_jenis_id' => $jenis->id,
                    'kas_t_kategori_id' => $kategori->id,
                    'kas_id' => $this->d_kas_id,
                    'nominal' => $this->d_jumlah,
                    'keterangan' => 'tagih piutang ' . $this->d_nama,
                    'user_id' => auth()->user()->id,
                ]);

                Piutang::create([
                    'pelanggan_id' => $this->d_id,
                    'jenis' => 'kurang',
                    'kas_id' => $this->d_kas_id,
                    'kas_transaksi_id' => $kasT->id,
                    'jumlah' => $this->d_jumlah,
                    'keterangan' => $this->d_keterangan,
                    'user_id' => auth()->user()->id,
                ]);

                $pel->update([
                    'piutang_usaha' => $pel->piutang_usaha - $this->d_jumlah,
                ]);

                $this->resetData();
                $this->emit('success', ['pesan' => 'Berhasil bayar piutang']);
                $this->kurangPage = false;
            }

        } catch (\Exception$e) {
            dd($e->getMessage());
        }

    }

    public function batalKurang()
    {
        $this->resetData();
        $this->kurangPage = false;
    }

}
