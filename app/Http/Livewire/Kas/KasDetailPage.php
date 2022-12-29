<?php

namespace App\Http\Livewire\Kas;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use Livewire\Component;

class KasDetailPage extends Component
{
    public $kas = [];

    public $editPage = false;

    public $kasID;

    public $ID;
    public $no, $nama, $tipe, $saldo, $bank, $norek, $an;

    public $kasTransaksi = [];
    public $takeKasTransaksi = 15;

    public $saldoMasukTotal, $saldoKeluarTotal;
    public $saldoMasuk, $saldoKeluar;

    public function render()
    {

        $transfer = KasTKategori::where('nama', 'transfer')->first()->id;

        $jenisMasuk = KasTJenis::where('nama', 'masuk')->first()->id;
        $this->saldoMasukTotal = KasTransaksi::where('kas_id', $this->kasID)->where('kas_t_jenis_id', $jenisMasuk)->get()->sum('nominal');
        $this->saldoMasuk = KasTransaksi::where('kas_id', $this->kasID)->where('kas_t_jenis_id', $jenisMasuk)->where('kas_t_kategori_id', '!=', $transfer)->get()->sum('nominal');
        $jenisKeluar = KasTJenis::where('nama', 'keluar')->first()->id;
        $this->saldoKeluarTotal = KasTransaksi::where('kas_id', $this->kasID)->where('kas_t_jenis_id', $jenisKeluar)->get()->sum('nominal');
        $this->saldoKeluar = KasTransaksi::where('kas_id', $this->kasID)->where('kas_t_jenis_id', $jenisKeluar)->where('kas_t_kategori_id', '!=', $transfer)->get()->sum('nominal');

        $this->kasTransaksi = KasTransaksi::with('kas', 'jenis', 'kategori', 'user')->where('kas_id', $this->kasID)->latest()->take($this->takeKasTransaksi)->get();
        return view('livewire.kas.kas-detail-page')->extends('layouts.app')->section('content');
    }

    public function mount($id)
    {
        $this->kas = Kas::find($id);
        $this->kasID = $id;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->no = null;
        $this->nama = null;
        $this->tipe = null;
        $this->saldo = null;
        $this->bank = null;
        $this->norek = null;
        $this->an = null;
    }

    public function editPage($id)
    {
        $data = Kas::find($id);
        $this->ID = $data->id;
        $this->no = $data->no;
        $this->nama = $data->nama;
        $this->tipe = $data->tipe;
        $this->saldo = $data->saldo;
        $this->bank = $data->bank;
        $this->norek = $data->norek;
        $this->an = $data->an;

        $this->editPage = true;
    }

    public function editPageClose()
    {
        $this->resetData();
        $this->editPage = false;
    }

    public function edit()
    {
        $user = User::find($this->ID);

        $user->update([
            'no' => $this->no,
            'tipe' => $this->tipe,
            'nama' => $this->nama,
            'saldo' => $this->saldo,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil ubah data']);
    }
}
