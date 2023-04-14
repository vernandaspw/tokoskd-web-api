<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Kasir;
use App\Models\KasirLog;
use App\Models\KasirReport;
use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Penjualan\Penjualan;
use Carbon\Carbon;
use Livewire\Component;

class KasirPage extends Component
{
    public $createPage = false, $editPage = false;

    public $nama;

    public $editID;

    public $kasiractive, $kasirdeactive = [];

    public $kasData;

    public $kas_tutup, $selisih, $kas_ditarik, $sisa_dikasir;
    // public $total_uang_masuk;

    public $take_report = 15;

    public function take_report()
    {
        $this->take_report += 15;
    }

    public function render()
    {
        $this->kasiractive = Kasir::with('kasir_report', 'kas')->where('isaktif', true)->get();

        $this->kasirdeactive = Kasir::where('isaktif', false)->latest()->get();

        $this->KasirReportAll = KasirReport::latest()->take($this->take_report)->get();

        if ($this->kasiractive == null) {
            // ada
            foreach ($this->kasiractive as $data) {
                $dc = $data->kas->sum('saldo_selisih');
            }

            $this->total_selisih = $dc;
        } else {
            $this->total_selisih = 0;
        }

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

            // cari masuk
            $masuk = KasTJenis::where('nama', 'masuk')->first()->id;
            $kasTrMasuk = KasTransaksi::where('kas_id', $this->kasData->id)->whereBetween('created_at', [$report->created_at, now()]);
            $this->total_uang_masuk = $kasTrMasuk->where('kas_t_jenis_id', $masuk)->get()->sum('nominal');

            // keluar
            $keluar = KasTJenis::where('nama', 'keluar')->first()->id;
            $kasTrKeluar = KasTransaksi::where('kas_id', $this->kasData->id)->whereBetween('created_at', [$report->created_at, now()]);
            $this->total_uang_keluar = $kasTrKeluar->where('kas_t_jenis_id', $keluar)->get()->sum('nominal');
            // dd($this->total_uang_keluar);

            $cekKasir = Kasir::find($this->kasirID);
            $this->kasData = $cekKasir->kas;
            $this->kas_akhir = $this->kasData->saldo;

            // $this->kas_tutup = ;
            $this->selisih = ($this->kas_tutup != null ? $this->kas_tutup : 0) - $this->kas_akhir;

            // ditarik
            // sisa dikasir = $kas_tutup - ditarik
            // $this->kas_ditarik = $this->kas_ditarik != null ? $this->kas_ditarik : 0;

            $this->sisa_dikasir = $this->kas_ditarik != null ? ($this->kas_tutup != null ? $this->kas_tutup : 0) - ($this->kas_ditarik != null ? $this->kas_ditarik : 0) : 0;
            // $this->sisa_dikasir = $kas_sisa_dikasir;

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

        if ($this->terimaKasTutupID) {
            $report = KasirReport::find($this->terimaKasTutupID);
            if ($this->revisi_kas_ditarik) {
                $revisi_kas_ditarik = $this->revisi_kas_ditarik;
            } else {
                $revisi_kas_ditarik = $report->kas_ditarik;
                $this->revisi_kas_ditarik = $revisi_kas_ditarik;
            }
            $this->revisi_sisa_dikasir = $report->kas_tutup - $revisi_kas_ditarik;
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

        redirect('penjualan/kasir/' . $id);
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

    public function close()
    {
        $this->bukaKas_id = null;
        $this->tutupKas_id = null;
        $this->reportID = null;
        $this->kasirID = null;
        $this->namaKasir = null;
    }

    public $bukaSimpanLoading = false;
    public function buka_kas_simpan()
    {
        $this->bukaSimpanLoading = true;
        KasirReport::create([
            'kasir_id' => $this->bukaKas_id,
            'kas_awal' => $this->kasData->saldo,
            'buka_oleh' => auth()->user()->id,
            'status' => 'open',
        ]);
        $this->kasir_detail($this->bukaKas_id);
        $this->bukaSimpanLoading = false;
    }

    public function tutup_kas_toggle($id)
    {
        $this->tutupKas_id = $id;
        $this->kasirID = $id;

        // cari report yang kasir_id nya open
        $cari_report = KasirReport::where('kasir_id', $id)->where('status', 'open')->first();
        $this->reportID = $cari_report->id;
        $this->namaKasir = Kasir::find($id)->nama;
    }

    public function tutup_kas_simpan()
    {
        $d = KasirReport::find($this->reportID);
        if ($this->kas_ditarik > $this->kas_ditarik) {
            $this->emit('error', ['pesan' => 'jumlah kas ditarik tidak boleh melebihi jumlah tutup kas']);
        } elseif ($this->kas_ditarik <= $this->kas_ditarik) {
            $d->update([
                'total_uang_masuk' => $this->total_uang_masuk,
                'total_uang_keluar' => $this->total_uang_keluar,
                'kas_akhir' => $this->kas_akhir,
                'kas_tutup' => $this->kas_tutup,
                'selisih' => $this->selisih,
                'kas_ditarik' => $this->kas_ditarik,
                'sisa_dikasir' => $this->sisa_dikasir,
                'jumlah_transaksi' => $this->jumlah_penjualan,
                'tagihan_utang' => $this->tagihan_utang,
                'uang_tunai' => $this->uang_tunai,
                'uang_nontunai' => $this->uang_nontunai,
                'tagihan_utang' => $this->tagihan_utang,
                'omset' => $this->omset,
                'untung' => $this->untung,
                'tutup_oleh' => auth()->user()->id,
                'tutup_at' => now(),
                'status' => 'pending',
            ]);
            // update kas
            // $kasir = Kasir::find($this->kasirID);
            // $kasKasir = Kas::find($kasir->kas_id);
            // $kasKasir->update([

            // ]);

            $this->emit('cetakStrukTutup', ['url' => url('penjualan/struk/kasir/tutup/' . $this->reportID), 'title' => 'struk laporan tutup kas']);
            $this->close();
        }

    }

    public $revisi_kas_ditarik;

    public $terimaKasTutupID;
    // jgn lupa reset jika telah Terima

    public $terimaKasTutupPage = false;

    public $kr_kas_awal,
    $kr_total_uang_masuk,
    $kr_total_uang_keluar,
    $kr_kas_akhir,
    $kr_kas_tutup,
    $kr_selisih,
    $kr_kas_ditarik,
    $kr_sisa_dikasir,
    $kr_jumlah_transaksi,
    $kr_uang_tunai,
    $kr_uang_nontunai,
    $kr_tagihan_utang,
    $kr_omset,
    $kr_untung,
    $kr_buka_oleh,
    $kr_tutup_oleh,
        $kr_tutup_at
    ;

    public function resetTerimaTutupKas()
    {
        $this->terimaKasTutupID = null;
        $this->kr_kas_awal = null;
        $this->kr_total_uang_masuk = null;
        $this->kr_total_uang_keluar = null;
        $this->kr_kas_akhir = null;
        $this->kr_kas_tutup = null;
        $this->kr_selisih = null;
        $this->kr_kas_ditarik = null;
        $this->kr_sisa_dikasir = null;
        $this->kr_jumlah_transaksi = null;
        $this->kr_uang_tunai = null;
        $this->kr_uang_nontunai = null;
        $this->kr_tagihan_utang = null;
        $this->kr_omset = null;
        $this->kr_untung = null;
        $this->kr_buka_oleh = null;
        $this->kr_tutup_oleh = null;
        $this->kr_tutup_at = null;
    }
    public function closeTutupTerimaKas()
    {
        $this->terimaKasTutupPage = false;
        $this->resetTerimaTutupKas();
    }
    public function terimaKasTutupToggle($id)
    {
        $this->terimaKasTutupID = $id;
        $this->terimaKasTutupPage = true;

        $report = KasirReport::find($id);
        $this->kr_kas_awal = $report->kas_awal;
        $this->kr_total_uang_masuk = $report->total_uang_masuk;
        $this->kr_total_uang_keluar = $report->total_uang_keluar;
        $this->kr_kas_akhir = $report->kas_akhir;
        $this->kr_kas_tutup = $report->kas_tutup;
        $this->kr_selisih = $report->selisih;
        $this->kr_kas_ditarik = $report->kas_ditarik;
        $this->kr_sisa_dikasir = $report->sisa_dikasir;
        $this->kr_jumlah_transaksi = $report->jumlah_transaksi;
        $this->kr_uang_tunai = $report->uang_tunai;
        $this->kr_uang_nontunai = $report->uang_nontunai;
        $this->kr_tagihan_utang = $report->tagihan_utang;
        $this->kr_omset = $report->omset;
        $this->kr_untung = $report->untung;
        $this->kr_buka_oleh = $report->buka_oleh;
        $this->kr_tutup_oleh = $report->tutup_oleh;
        $this->kr_tutup_at = $report->tutup_at;
    }

    public $revisi_sisa_dikasir;
    public function terimaKasTutup()
    {
        if ($this->terimaKasTutupID) {
            $id = $this->terimaKasTutupID;
            $report = KasirReport::find($id);

            $kategori_id = KasTKategori::where('nama', 'tutup kasir')->first()->id;

            $kas = Kas::find($report->kasir->kas_id);
            $kasTujuan = Kas::find(1);

            if ($this->revisi_kas_ditarik > $report->kas_tutup) {
                $this->emit('error', ['pesan' => 'Jumlah tarik tidak boleh melebihi jumlah tutup kas']);
            } elseif ($this->revisi_kas_ditarik <= $report->kas_tutup) {
                // jika ada perubahan kas ditarik ketika terima
                $revisi_kas_ditarik = $this->revisi_kas_ditarik != null ? $this->revisi_kas_ditarik : $report->kas_ditarik;
                $revisi_sisa_dikasir = $report->kas_tutup - $revisi_kas_ditarik;

                $asal_saldo = $kas->saldo - ($report->kas_tutup - $revisi_kas_ditarik);
                // dd($asal_saldo);
                $asal_saldo_selisih = $kas->saldo_selisih + $report->selisih;
                // ASAL
                $jenisKeluar = KasTJenis::where('nama', 'keluar')->first();
                $asal = KasTransaksi::create([
                    'kas_t_jenis_id' => $jenisKeluar->id,
                    'kas_t_kategori_id' => $kategori_id,
                    'kas_id' => $report->kasir->kas_id,
                    'nominal' => $this->revisi_kas_ditarik,
                    'keterangan' => 'asal kas tutup',
                    'user_id' => auth()->user()->id,
                ]);

                $kas->update([
                    'saldo' => $kas->saldo - $asal_saldo,
                    'saldo_selisih' => $asal_saldo_selisih,
                ]);

                $jenisMasuk = KasTJenis::where('nama', 'masuk')->first();
                // Tujuan /masuk

                // LANJUT DISINI
                $trx = KasTransaksi::create([
                    'kas_t_jenis_id' => $jenisMasuk->id,
                    'kas_t_kategori_id' => $kategori_id,
                    'kas_id' => $kasTujuan->id,
                    'nominal' => $this->revisi_kas_ditarik,
                    'keterangan' => 'dari kas tutup',
                    'user_id' => auth()->user()->id,
                    'asal_id' => $asal->id,
                ]);

                $kasTujuan->update([
                    'saldo' => $kasTujuan->saldo + $this->revisi_kas_ditarik,
                ]);

                $report->update([
                    'kas_ditarik' => $revisi_kas_ditarik,
                    'sisa_dikasir' => $revisi_sisa_dikasir,
                    'status' => 'close',
                ]);
                $this->resetTerimaTutupKas();
                $this->terimaKasTutupPage = false;
                $this->emit('success', ['pesan' => 'Berhasil terima uang dari tutup kasir']);
            }
        } else {
            $this->emit('error', ['pesan' => 'Tidak memiliki id kasir report']);
        }

    }

    public function cetak()
    {
        $this->emit('cetakStrukTutup', ['url' => url('penjualan/struk/kasir/tutup/' . $this->reportID), 'title' => 'struk laporan tutup kas']);
    }

    public $laporan_id = null;

    public function laporanShow($id)
    {
        $this->laporan_id = $id;
        $kasir = Kasir::find($id);

    }

}
