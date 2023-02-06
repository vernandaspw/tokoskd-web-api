<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class DashboardUtama extends Component
{
    public $date;

    public function render()
    {
        // if ($this->date) {

        // }
        $this->kasSaldo = Kas::get();
        $this->arusKasChart();
        $this->arusPenjualanChart();


        return view('livewire.dashboard.dashboard-utama')->extends('layouts.app')->section('content');
    }

    public function arusKasChart()
    {
        // kecuali kan kategori
        // saldo awal, transfer, tutup kasir
        $saldo_awal = KasTKategori::where('nama', 'saldo awal')->first()->id;
        $transfer = KasTKategori::where('nama', 'transfer')->first()->id;
        $tutup_kasir = KasTKategori::where('nama', 'tutup kasir')->first()->id;

        // data
        $jenis_kas_masuk = KasTJenis::where('nama', 'masuk')->first()->id;
        // dd(date('Y-m-d', strtotime('-30 day')));

        $this->KasTMasukminD30 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('nominal');
        $this->KasTMasukminD29 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('nominal');
        $this->KasTMasukminD28 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('nominal');
        $this->KasTMasukminD27 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('nominal');
        $this->KasTMasukminD26 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('nominal');
        $this->KasTMasukminD25 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('nominal');
        $this->KasTMasukminD24 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('nominal');
        $this->KasTMasukminD23 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('nominal');
        $this->KasTMasukminD22 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('nominal');
        $this->KasTMasukminD21 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('nominal');
        $this->KasTMasukminD20 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('nominal');
        $this->KasTMasukminD19 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('nominal');
        $this->KasTMasukminD18 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('nominal');
        $this->KasTMasukminD17 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('nominal');
        $this->KasTMasukminD16 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('nominal');
        $this->KasTMasukminD15 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('nominal');
        $this->KasTMasukminD14 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('nominal');
        $this->KasTMasukminD13 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('nominal');
        $this->KasTMasukminD12 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('nominal');
        $this->KasTMasukminD11 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('nominal');
        $this->KasTMasukminD10 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('nominal');
        $this->KasTMasukminD09 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('nominal');
        $this->KasTMasukminD08 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('nominal');
        $this->KasTMasukminD07 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('nominal');
        $this->KasTMasukminD06 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('nominal');
        $this->KasTMasukminD05 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('nominal');
        $this->KasTMasukminD04 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('nominal');
        $this->KasTMasukminD03 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('nominal');
        $this->KasTMasukminD02 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('nominal');
        $this->KasTMasukminD01 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('nominal');
        $this->KasTMasukminD00 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('nominal');

        // ->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)
        $jenis_kas_keluar = KasTJenis::where('nama', 'keluar')->first()->id;
        $this->KasTKeluarminD30 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('nominal');
        $this->KasTKeluarminD29 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('nominal');
        $this->KasTKeluarminD28 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('nominal');
        $this->KasTKeluarminD27 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('nominal');
        $this->KasTKeluarminD26 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('nominal');
        $this->KasTKeluarminD25 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('nominal');
        $this->KasTKeluarminD24 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('nominal');
        $this->KasTKeluarminD23 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('nominal');
        $this->KasTKeluarminD22 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('nominal');
        $this->KasTKeluarminD21 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('nominal');
        $this->KasTKeluarminD20 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('nominal');
        $this->KasTKeluarminD19 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('nominal');
        $this->KasTKeluarminD18 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('nominal');
        $this->KasTKeluarminD17 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('nominal');
        $this->KasTKeluarminD16 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('nominal');
        $this->KasTKeluarminD15 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('nominal');
        $this->KasTKeluarminD14 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('nominal');
        $this->KasTKeluarminD13 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('nominal');
        $this->KasTKeluarminD12 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('nominal');
        $this->KasTKeluarminD11 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('nominal');
        $this->KasTKeluarminD10 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('nominal');
        $this->KasTKeluarminD09 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('nominal');
        $this->KasTKeluarminD08 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('nominal');
        $this->KasTKeluarminD07 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('nominal');
        $this->KasTKeluarminD06 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('nominal');
        $this->KasTKeluarminD05 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('nominal');
        $this->KasTKeluarminD04 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('nominal');
        $this->KasTKeluarminD03 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('nominal');
        $this->KasTKeluarminD02 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('nominal');
        $this->KasTKeluarminD01 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('nominal');
        $this->KasTKeluarminD00 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('nominal');

        $this->KasTMasukminM12 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('nominal');
        $this->KasTMasukminM11 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('nominal');
        $this->KasTMasukminM10 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('nominal');
        $this->KasTMasukminM09 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('nominal');
        $this->KasTMasukminM08 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('nominal');
        $this->KasTMasukminM07 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('nominal');
        $this->KasTMasukminM06 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('nominal');
        $this->KasTMasukminM05 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('nominal');
        $this->KasTMasukminM04 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('nominal');
        $this->KasTMasukminM03 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('nominal');
        $this->KasTMasukminM02 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('nominal');
        $this->KasTMasukminM01 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('nominal');
        $this->KasTMasukminM00 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_masuk)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('nominal');

        $this->KasTKeluarminM12 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('nominal');
        $this->KasTKeluarminM11 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('nominal');
        $this->KasTKeluarminM10 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('nominal');
        $this->KasTKeluarminM09 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('nominal');
        $this->KasTKeluarminM08 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('nominal');
        $this->KasTKeluarminM07 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('nominal');
        $this->KasTKeluarminM06 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('nominal');
        $this->KasTKeluarminM05 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('nominal');
        $this->KasTKeluarminM04 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('nominal');
        $this->KasTKeluarminM03 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('nominal');
        $this->KasTKeluarminM02 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('nominal');
        $this->KasTKeluarminM01 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('nominal');
        $this->KasTKeluarminM00 = KasTransaksi::where('kas_t_jenis_id', $jenis_kas_keluar)->where('kas_t_kategori_id', '!=', $saldo_awal)->where('kas_t_kategori_id', '!=', $transfer)->where('kas_t_kategori_id', '!=', $tutup_kasir)->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('nominal');
    }

    public function arusPenjualanChart()
    {
        // pendapatan
        // omset
        // untung

        // harga pokok 30 Hari tarakhir
        $this->total_harga_pokokPenjualanD30 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD29 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD28 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD27 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD26 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD25 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD24 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD23 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD22 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD21 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD20 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD19 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD18 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD17 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD16 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD15 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD14 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD13 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD12 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD11 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD10 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD09 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD08 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD07 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD06 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD05 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD04 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD03 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD02 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD01 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanD00 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('total_harga_pokok');

        // harga jual 30 Hari tarakhir
        $this->total_harga_jualPenjualanD30 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD29 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD28 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD27 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD26 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD25 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD24 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD23 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD22 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD21 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD20 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD19 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD18 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD17 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD16 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD15 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD14 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD13 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD12 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD11 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD10 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD09 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD08 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD07 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD06 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD05 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD04 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD03 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD02 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD01 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanD00 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('total_harga_jual');

        // omset 30 hari terakhir
        $this->omsetPendapatanD30 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('omset');
        $this->omsetPendapatanD29 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('omset');
        $this->omsetPendapatanD28 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('omset');
        $this->omsetPendapatanD27 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('omset');
        $this->omsetPendapatanD26 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('omset');
        $this->omsetPendapatanD25 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('omset');
        $this->omsetPendapatanD24 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('omset');
        $this->omsetPendapatanD23 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('omset');
        $this->omsetPendapatanD22 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('omset');
        $this->omsetPendapatanD21 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('omset');
        $this->omsetPendapatanD20 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('omset');
        $this->omsetPendapatanD19 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('omset');
        $this->omsetPendapatanD18 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('omset');
        $this->omsetPendapatanD17 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('omset');
        $this->omsetPendapatanD16 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('omset');
        $this->omsetPendapatanD15 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('omset');
        $this->omsetPendapatanD14 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('omset');
        $this->omsetPendapatanD13 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('omset');
        $this->omsetPendapatanD12 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('omset');
        $this->omsetPendapatanD11 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('omset');
        $this->omsetPendapatanD10 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('omset');
        $this->omsetPendapatanD09 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('omset');
        $this->omsetPendapatanD08 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('omset');
        $this->omsetPendapatanD07 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('omset');
        $this->omsetPendapatanD06 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('omset');
        $this->omsetPendapatanD05 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('omset');
        $this->omsetPendapatanD04 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('omset');
        $this->omsetPendapatanD03 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('omset');
        $this->omsetPendapatanD02 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('omset');
        $this->omsetPendapatanD01 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('omset');
        $this->omsetPendapatanD00 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('omset');

        // untung
        $this->untungPendapatanD30 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-30 day')))->get()->sum('untung');
        $this->untungPendapatanD29 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-29 day')))->get()->sum('untung');
        $this->untungPendapatanD28 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-28 day')))->get()->sum('untung');
        $this->untungPendapatanD27 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-27 day')))->get()->sum('untung');
        $this->untungPendapatanD26 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-26 day')))->get()->sum('untung');
        $this->untungPendapatanD25 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-25 day')))->get()->sum('untung');
        $this->untungPendapatanD24 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-24 day')))->get()->sum('untung');
        $this->untungPendapatanD23 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-23 day')))->get()->sum('untung');
        $this->untungPendapatanD22 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-22 day')))->get()->sum('untung');
        $this->untungPendapatanD21 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-21 day')))->get()->sum('untung');
        $this->untungPendapatanD20 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-20 day')))->get()->sum('untung');
        $this->untungPendapatanD19 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-19 day')))->get()->sum('untung');
        $this->untungPendapatanD18 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-18 day')))->get()->sum('untung');
        $this->untungPendapatanD17 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-17 day')))->get()->sum('untung');
        $this->untungPendapatanD16 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-16 day')))->get()->sum('untung');
        $this->untungPendapatanD15 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-15 day')))->get()->sum('untung');
        $this->untungPendapatanD14 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-14 day')))->get()->sum('untung');
        $this->untungPendapatanD13 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-13 day')))->get()->sum('untung');
        $this->untungPendapatanD12 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-12 day')))->get()->sum('untung');
        $this->untungPendapatanD11 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-11 day')))->get()->sum('untung');
        $this->untungPendapatanD10 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-10 day')))->get()->sum('untung');
        $this->untungPendapatanD09 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-09 day')))->get()->sum('untung');
        $this->untungPendapatanD08 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-08 day')))->get()->sum('untung');
        $this->untungPendapatanD07 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-07 day')))->get()->sum('untung');
        $this->untungPendapatanD06 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-06 day')))->get()->sum('untung');
        $this->untungPendapatanD05 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-05 day')))->get()->sum('untung');
        $this->untungPendapatanD04 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-04 day')))->get()->sum('untung');
        $this->untungPendapatanD03 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-03 day')))->get()->sum('untung');
        $this->untungPendapatanD02 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-02 day')))->get()->sum('untung');
        $this->untungPendapatanD01 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-01 day')))->get()->sum('untung');
        $this->untungPendapatanD00 = Penjualan::where('islunas', true)->where('status', 'success')->whereDate('created_at', date('Y-m-d', strtotime('-00 day')))->get()->sum('untung');


        // ==========================================================================
        // BULAN
        // ==========================================================================
        // harga pokok
        $this->total_harga_pokokPenjualanB12 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB11 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB10 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB09 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB08 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB07 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB06 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB05 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB04 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB03 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB02 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB01 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('total_harga_pokok');
        $this->total_harga_pokokPenjualanB00 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('total_harga_pokok');

        // harga jual
        $this->total_harga_jualPenjualanB12 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB11 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB10 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB09 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB08 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB07 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB06 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB05 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB04 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB03 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB02 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB01 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('total_harga_jual');
        $this->total_harga_jualPenjualanB00 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('total_harga_jual');

        // omset
        $this->omsetPenjualanB12 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('omset');
        $this->omsetPenjualanB11 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('omset');
        $this->omsetPenjualanB10 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('omset');
        $this->omsetPenjualanB09 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('omset');
        $this->omsetPenjualanB08 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('omset');
        $this->omsetPenjualanB07 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('omset');
        $this->omsetPenjualanB06 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('omset');
        $this->omsetPenjualanB05 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('omset');
        $this->omsetPenjualanB04 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('omset');
        $this->omsetPenjualanB03 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('omset');
        $this->omsetPenjualanB02 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('omset');
        $this->omsetPenjualanB01 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('omset');
        $this->omsetPenjualanB00 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('omset');

        // Untung
        $this->untungPenjualanB12 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-12 month')))->whereYear('created_at', date('Y', strtotime('-1 year')))->get()->sum('untung');
        $this->untungPenjualanB11 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-11 month')))->get()->sum('untung');
        $this->untungPenjualanB10 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-10 month')))->get()->sum('untung');
        $this->untungPenjualanB09 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-09 month')))->get()->sum('untung');
        $this->untungPenjualanB08 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-08 month')))->get()->sum('untung');
        $this->untungPenjualanB07 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-07 month')))->get()->sum('untung');
        $this->untungPenjualanB06 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-06 month')))->get()->sum('untung');
        $this->untungPenjualanB05 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-05 month')))->get()->sum('untung');
        $this->untungPenjualanB04 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-04 month')))->get()->sum('untung');
        $this->untungPenjualanB03 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-03 month')))->get()->sum('untung');
        $this->untungPenjualanB02 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-02 month')))->get()->sum('untung');
        $this->untungPenjualanB01 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-01 month')))->get()->sum('untung');
        $this->untungPenjualanB00 = Penjualan::where('islunas', true)->where('status', 'success')->whereMonth('created_at', date('m', strtotime('-00 month')))->get()->sum('untung');
    }
}
