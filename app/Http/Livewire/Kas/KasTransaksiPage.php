<?php

namespace App\Http\Livewire\Kas;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use Livewire\Component;

class KasTransaksiPage extends Component
{
    public $masukPage = true, $keluarPage = false, $transferPage = false;

    public $kas = [], $kategoriMasuk = [], $kategoriKeluar = [];

    public $jenisMasuk_id, $jenisKeluar_id;

    public $kas_id, $jenis_id, $kategori_id, $nominal, $keterangan;
    public $tujuan_id;

    public function render()
    {
        $this->kas = Kas::where('isaktif', true)->get();

        $jenisMasuk = KasTJenis::where('nama', 'masuk')->first();
        $this->jenisMasuk_id = $jenisMasuk->id;
        $this->kategoriMasuk = KasTKategori::where('kas_t_jenis_id', $this->jenisMasuk_id)->get();

        $jenisKeluar = KasTJenis::where('nama', 'keluar')->first();
        $this->jenisKeluar_id = $jenisKeluar->id;
        $this->kategoriKeluar = KasTKategori::where('kas_t_jenis_id', $this->jenisKeluar_id)->get();

        return view('livewire.kas.kas-transaksi-page')->extends('layouts.app')->section('content');
    }

    public function masukPage()
    {
        if ($this->masukPage == true) {
            $this->masukPage = false;
        } else {
            $this->masukPage = true;
            $this->keluarPage = false;
            $this->transferPage = false;
        }
    }

    public function keluarPage()
    {
        if ($this->keluarPage == true) {
            $this->keluarPage = false;
        } else {
            $this->keluarPage = true;
            $this->masukPage = false;
            $this->transferPage = false;
        }
    }

    public function transferPage()
    {
        if ($this->transferPage == true) {
            $this->transferPage = false;
        } else {
            $this->transferPage = true;
            $this->masukPage = false;
            $this->keluarPage = false;
        }
    }

    public function resetData()
    {
        $this->jenis_id = null;
        $this->kategori_id = null;
        $this->kas_id = null;
        $this->nominal = null;
        $this->keterangan = null;
        $this->tujuan_id = null;
    }

    public $pilih_tanggal, $pilih_jam;

    public function masuk()
    {
        $tanggal = $this->pilih_tanggal != null ? date('Y-m-d', strtotime($this->pilih_tanggal)) : date('Y-m-d');
        $jam = $this->pilih_jam != null ? date('H:i:s', strtotime($this->pilih_jam)) : date('H:i:s');

        $trx = KasTransaksi::create([
            'kas_t_jenis_id' => $this->jenisMasuk_id,
            'kas_t_kategori_id' => $this->kategori_id,
            'kas_id' => $this->kas_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'user_id' => auth()->user()->id,
            'created_at' => $tanggal.' '.$jam
        ]);

        $kas = Kas::find($this->kas_id);
        $kas->update([
            'saldo' => $kas->saldo + $this->nominal,
        ]);

        $this->resetData();
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
    }

    public function keluar()
    {
        $tanggal = $this->pilih_tanggal != null ? date('Y-m-d', strtotime($this->pilih_tanggal)) : date('Y-m-d');
        $jam = $this->pilih_jam != null ? date('H:i:s', strtotime($this->pilih_jam)) : date('H:i:s');
        // cek saldo
        $kas = Kas::find($this->kas_id);

        if ($kas->saldo <= 0) {
            $this->emit('error', ['pesan' => 'Saldo tidak cukup!']);
        }else if (($kas->saldo < $this->nominal)) {
            $this->emit('error', ['pesan' => 'Saldo tidak cukup!']);
        }elseif ($kas->saldo >= $this->nominal) {

        $trx = KasTransaksi::create([
            'kas_t_jenis_id' => $this->jenisKeluar_id,
            'kas_t_kategori_id' => $this->kategori_id,
            'kas_id' => $this->kas_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'user_id' => auth()->user()->id,
            'created_at' => $tanggal.' '.$jam
        ]);

        $kas->update([
            'saldo' => $kas->saldo - $this->nominal,
        ]);

        $this->resetData();
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
        }
    }



    public function transfer()
    {
        // cek saldo asal, jika kurang tidak bisa transfer
        $tanggal = $this->pilih_tanggal != null ? date('Y-m-d', strtotime($this->pilih_tanggal)) : date('Y-m-d');
        $jam = $this->pilih_jam != null ? date('H:i:s', strtotime($this->pilih_jam)) : date('H:i:s');

        $kategori_id = KasTKategori::where('nama', 'transfer')->first()->id;
        // ASAL
        $asal = KasTransaksi::create([
            'kas_t_jenis_id' => $this->jenisKeluar_id,
            'kas_t_kategori_id' => $kategori_id,
            'kas_id' => $this->kas_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'user_id' => auth()->user()->id,
            'created_at' => $tanggal.' '.$jam
        ]);
        $kas = Kas::find($this->kas_id);
        $kas->update([
            'saldo' => $kas->saldo - $this->nominal,
        ]);

        // Tujuan
        $trx = KasTransaksi::create([
            'kas_t_jenis_id' => $this->jenisMasuk_id,
            'kas_t_kategori_id' => $kategori_id,
            'kas_id' => $this->tujuan_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'user_id' => auth()->user()->id,
            'asal_id' => $asal->id,
            'created_at' => $tanggal.' '.$jam
        ]);
        $kasTujuan = Kas::find($this->tujuan_id);
        $kasTujuan->update([
            'saldo' => $kasTujuan->saldo + $this->nominal,
        ]);

        $this->resetData();
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);
    }

}
