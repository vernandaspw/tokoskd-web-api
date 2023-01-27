<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Kasir;
use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\KasirLog;
use App\Models\KasirReport;
use App\Models\Penjualan\Penjualan;
use Carbon\Carbon;
use Livewire\Component;

class KasirPage extends Component
{
    public $createPage = false, $editPage = false;

    public $nama;

    public $editID;

    public $kasiractive = [], $kasirdeactive = [];

    public $kasData;

    public $kas_tutup, $selisih;
    // public $total_uang_masuk;

    public $take_report = 15;

    public function take_report()
    {
        $this->take_report += 15;
    }

    public function render()
    {
        $this->kasiractive = Kasir::with('kasir_report', 'kas')->where('isaktif', true)->latest()->get();

        $this->kasirdeactive = Kasir::where('isaktif', false)->latest()->get();

        $this->KasirReportAll = KasirReport::latest()->take($this->take_report)->get();

        foreach ($this->kasiractive as $data) {
          $datas = $data->kas->sum('saldo_selisih');
        }
        $this->total_selisih = $datas;

        if ($this->bukaKas_id) {

            $cekKasir = Kasir::find($this->bukaKas_id);
            $this->kasData = $cekKasir->kas;
            $this->KasirReport = KasirReport::where('kasir_id', $this->bukaKas_id)->latest()->get();
        }
        if ($this->tutupKas_id) {
            $cekKasir = Kasir::find($this->tutupKas_id);
            $this->kasData = $cekKasir->kas;

            $this->KasirReport = KasirReport::where('kasir_id', $this->tutupKas_id)->latest()->get();
        }
        if ($this->laporan_id) {
            $kasir = Kasir::find($this->laporan_id);
            $this->KasirReport = KasirReport::with('buka_olehs')->where('kasir_id', $kasir->id)->latest()->get();
        }
        if ($this->reportID) {
            $report = KasirReport::find($this->reportID);

            $this->tutupR = KasirReport::find($this->reportID);
            $kasTr = KasTransaksi::where('kas_id', $this->kasData->id)->whereBetween('created_at', [$report->created_at, now()]);
            $masuk = KasTJenis::where('nama', 'masuk')->first()->id;
            $keluar = KasTJenis::where('nama', 'keluar')->first()->id;
            $this->total_uang_masuk = $kasTr->where('kas_t_jenis_id', $masuk)->get()->sum('nominal');
            $this->total_uang_keluar = $kasTr->where('kas_t_jenis_id', $keluar)->get()->sum('nominal');

            $cekKasir = Kasir::find($this->kasirID);
            $this->kasData = $cekKasir->kas;
            $this->kas_akhir = $this->kasData->saldo;

            $kas_tutup = $this->kas_tutup != null ? $this->kas_tutup : 0;
            $this->selisih =  $kas_tutup - $this->kas_akhir;

            // update saldo kas saat ini saat klik ismpan
            $this->saldo_kas = $this->kasData->saldo + $this->selisih;
            $this->saldo_selisih = $this->kasData->selisih - $this->selisih;

            $pen = Penjualan::where('kasir_id', $this->kasirID)->whereBetween('created_at', [$report->created_at, now()]);
            $this->jumlah_penjualan = $pen->get()->count();
            $this->uang_tunai = $pen->get()->sum('uang_tunai');
            $this->uang_nontunai = $pen->get()->sum('uang_nontunai');
            $this->tagihan_utang = $pen->get()->sum('tagihan_utang');
            $this->omset = $pen->get()->sum('omset');
            $this->untung = $pen->get()->sum('untung');

        }

        return view('livewire.penjualan.kasir-page')->extends('layouts.app')->section('content');
    }

    public function createPage()
    {
        if ($this->createPage == true) {
            $this->createPage = false;
        } else {
            $this->createPage = true;
        }
    }

    public function create()
    {

        try {
            $kas = Kas::create([
                'tipe' => 'tunai kasir',
                'nama' => $this->nama,
                'saldo' => 0,
            ]);

            Kasir::create([
                'nama' => $this->nama,
                'kas_id' => $kas->id,
            ]);

        } catch (\Exception$e) {
            dd($e->getMessage());
        } finally {
            $this->emit('success', ['pesan' => 'Berhasil simpan data']);
            redirect()->to('penjualan/kasir');
        }
    }

    public function editPage($id)
    {
        $this->editID = $id;

        $d = Kasir::find($id);
        $this->nama = $d->nama;
        $this->editPage = true;
    }
    public function editPageClose()
    {
        $this->nama = null;
        $this->editPage = false;
    }

    public function edit()
    {
        $d = Kasir::find($this->editID);
        $d->update([
            'nama' => $this->nama,
        ]);

        $this->emit('success', ['pesan' => 'Berhasil edit data']);
    }

    public function kasir_detail($id)
    {
        $kasirlog = KasirLog::where('kasir_id', $id)->whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->first();

        if ($kasirlog == null) {
            KasirLog::create([
                'kasir_id' => $id,
                'user_id' => auth()->user()->id,
            ]);
        }

        redirect()->to('penjualan/kasir/'.$id);
    }


    public $bukaKas_id, $tutupKas_id, $namaKasir;
    public $reportID;

    public $kasirID;

    public function buka_kas_toggle($id)
    {
        $this->bukaKas_id = $id;
        $this->kasirID = $id;
        $this->namaKasir = Kasir::find($id)->nama;
    }

    public function tutup_kas_toggle($id,  $reportID)
    {
        $this->tutupKas_id = $id;
        $this->kasirID = $id;
        $this->reportID = $reportID;
        $this->namaKasir = Kasir::find($id)->nama;
    }

    public function close()
    {
        $this->bukaKas_id = null;
        $this->tutupKas_id = null;
        $this->reportID = null;
        $this->kasirID = null;
        $this->namaKasir = null;
    }

    public function buka_kas_simpan()
    {
        KasirReport::create([
            'kasir_id' => $this->bukaKas_id,
            'kas_awal' => $this->kasData->saldo,
            'buka_oleh' => auth()->user()->id,
            'status' => 'open'
        ]);
        $this->kasir_detail($this->bukaKas_id);
    }

    public function tutup_kas_simpan()
    {
        $d = KasirReport::find($this->reportID);
        $d->update([
            'total_uang_masuk' => $this->total_uang_masuk,
            'total_uang_keluar' => $this->total_uang_keluar,
            'kas_akhir' => $this->kas_akhir,
            'kas_tutup' => $this->kas_tutup,
            'selisih' => $this->selisih,
            'jumlah_transaksi' => $this->jumlah_penjualan,
            'tagihan_utang' => $this->tagihan_utang,
            'uang_tunai' => $this->uang_tunai,
            'uang_nontunai' => $this->uang_nontunai,
            'tagihan_utang' => $this->tagihan_utang,
            'omset' => $this->omset,
            'untung' => $this->untung,
            'tutup_oleh' => auth()->user()->id,
            'tutup_at' => now(),
            'status' => 'pending'
        ]);
        // update kas
        // $kasir = Kasir::find($this->kasirID);
        // $kasKasir = Kas::find($kasir->kas_id);
        // $kasKasir->update([

        // ]);

        $this->emit('cetakStrukTutup', ['url' => url('penjualan/struk/kasir/tutup/'. $this->reportID), 'title' => 'struk laporan tutup kas']);
        $this->close();
    }

    public function terimaKasTutup($id)
    {
        $report = KasirReport::find($id);


        $kategori_id = KasTKategori::where('nama', 'tutup kasir')->first()->id;

        $kas = Kas::find($report->kasir->kas_id);
        $kasTujuan = Kas::find(1);

        if ($report->selisih > 0) {
            // jika selisih bertambah
            $asal_saldo = $kas->saldo - ($report->kas_tutup - $report->selisih);
            $asal_saldo_selisih = $kas->saldo_selisih + $report->selisih;
        }else {
            // jika berkurang
            $asal_saldo = $kas->saldo - ($report->kas_tutup - $report->selisih);
            $asal_saldo_selisih = $kas->saldo_selisih + $report->selisih;
        }

        // ASAL
        $jenisKeluar = KasTJenis::where('nama', 'keluar')->first();
        $asal = KasTransaksi::create([
            'kas_t_jenis_id' => $jenisKeluar->id,
            'kas_t_kategori_id' => $kategori_id,
            'kas_id' => $report->kasir->kas_id,
            'nominal' => $report->kas_tutup,
            'keterangan' => 'asal kas tutup',
            'user_id' => auth()->user()->id,
        ]);

        $kas->update([
            'saldo' => $asal_saldo,
            'saldo_selisih' => $asal_saldo_selisih
        ]);

        $jenisMasuk = KasTJenis::where('nama', 'masuk')->first();
        // Tujuan /masuk

        $trx = KasTransaksi::create([
            'kas_t_jenis_id' => $jenisMasuk->id,
            'kas_t_kategori_id' => $kategori_id,
            'kas_id' => $kasTujuan->id,
            'nominal' => $report->kas_tutup,
            'keterangan' => 'dari kas tutup',
            'user_id' => auth()->user()->id,
            'asal_id' => $asal->id,
        ]);

        $kasTujuan->update([
            'saldo' => $kasTujuan->saldo + $report->kas_tutup,
        ]);

        $report->update([
            'status' => 'close'
        ]);

        $this->emit('success', ['pesan' => 'Berhasil terima uang dari tutup kasir']);
    }

    public function cetak()
    {
        $this->emit('cetakStrukTutup', ['url' => url('penjualan/struk/kasir/tutup/'. $this->reportID), 'title' => 'struk laporan tutup kas']);
    }

    public $laporan_id = null;

    public function laporanShow($id)
    {
        $this->laporan_id = $id;
        $kasir = Kasir::find($id);


    }

}
