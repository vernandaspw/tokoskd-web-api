<?php

namespace App\Http\Livewire\Kas;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTransaksi;
use Livewire\Component;

class KasPage extends Component
{
    public $kasTunai = [], $kasTunaiKasir = [], $kasBank = [], $kasEwallet = [];

    public $take = 10;
    public $tambahPage = false;

    public $ID;
    public $no, $nama, $tipe, $saldo, $bank, $norek, $an;


    protected $listeners = [
        'take-data' => 'takeKasTransaksi',
    ];

    public $kasTransaksi = [];
    public $takeKasTransaksi = 15;

    public function takeKasTransaksi()
    {
        $this->takeKasTransaksi += 15;
    }

    public $dateTransaksi, $pilih_kas_jenis_id;

    public function mount()
    {
        $this->dateTransaksi = date('Y-m-d');
    }


    public function render()
    {
        $this->kasTunai = Kas::where('tipe', 'tunai')->take($this->take)->orderBy('no', 'ASC')->get();
        $this->kasTunaiKasir = Kas::where('tipe', 'tunai kasir')->take($this->take)->orderBy('no', 'ASC')->get();
        $this->kasBank = Kas::where('tipe', 'bank')->take($this->take)->orderBy('no', 'ASC')->get();
        $this->kasEwallet = Kas::where('tipe', 'ewallet')->take($this->take)->orderBy('no', 'ASC')->get();

        $this->kasJenisTransaksi = KasTJenis::get();
        $dateTransaksi = $this->dateTransaksi != null ? $this->dateTransaksi : date('Y-m-d');



        $kast = KasTransaksi::with('kas', 'jenis', 'kategori', 'user');
        if($this->pilih_kas_jenis_id) {
            $kast->where('kas_t_jenis_id', $this->pilih_kas_jenis_id);
        }
        $kast->whereDate('created_at', $dateTransaksi);
        
        $this->kasTransaksi = $kast->latest()->take($this->takeKasTransaksi)->get();

        return view('livewire.kas.kas-page')->extends('layouts.app')->section('content');
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

    public function tambahPage()
    {
        if ($this->tambahPage == false) {
            $this->tambahPage = true;
        } else {
            $this->tambahPage = false;
        }
    }
    public function simpan()
    {
        $this->validate([
            'tipe' => 'required',
            'nama' => 'required',
        ]);

        Kas::create([
            'no' => $this->no,
            'tipe' => $this->tipe,
            'nama' => $this->nama,
            'saldo' => $this->saldo,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an
        ]);

        $this->resetData();
        $this->tambahPage = false;

        $this->emit('success', ['pesan' => 'Berhasil buat data']);
    }



}
