<?php

namespace App\Http\Livewire\Master;

use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SupplierPage extends Component
{
    use WithFileUploads;

    public $akun = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $img, $nama, $fax, $phone, $telp, $email, $provinsi, $kota, $alamat, $bank, $norek, $an, $npwp, $keterangan;
    public $newImg;

    public function render()
    {
        $this->akun = Supplier::latest()->take($this->take)->get();


        $this->kas = Kas::where('isaktif', true)->get();

        return view('livewire.master.supplier-page')->extends('layouts.app')->section('content');
    }

    public function next()
    {
        $this->take += 10;
    }

    // TAMBAH
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
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        if ($this->img) {
            $img = $this->img->store('img/olahraga');
        } else {
            $img = null;
        }

        Supplier::create([
            'img' => $img,
            'nama' => $this->nama,
            'phone' => $this->phone,
            'telp' => $this->telp,
            'fax' => $this->fax,
            'email' => $this->email,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'alamat' => $this->alamat,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an,
            'npwp' => $this->npwp,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();

        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

        $storage = Storage::disk('public');
        if ($storage) {
            foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
                $storage->delete($filePathname);
            }
        }
    }

    // EDIT
    public function editPage($id)
    {
        $user = Supplier::find($id);
        $this->ID = $user->id;
        $this->img = $user->img;
        $this->nama = $user->nama;
        $this->phone = $user->phone;
        $this->telp = $user->telp;
        $this->fax = $user->fax;
        $this->email = $user->email;
        $this->provinsi = $user->provinsi;
        $this->kota = $user->kota;
        $this->alamat = $user->alamat;
        $this->bank = $user->bank;
        $this->norek = $user->rekening;
        $this->an = $user->an;
        $this->npwp = $user->npwp;
        $this->keterangan = $user->keterangan;
        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->img = null;
        $this->nama = null;
        $this->phone = null;
        $this->telp = null;
        $this->fax = null;
        $this->email = null;
        $this->provinsi = null;
        $this->kota = null;
        $this->alamat = null;
        $this->bank = null;
        $this->norek = null;
        $this->an = null;
        $this->npwp = null;
        $this->keterangan = null;
    }

    public function editPageClose()
    {
        $this->resetData();
        $this->editPage = false;
    }

    public function edit()
    {
        $user = Supplier::find($this->ID);

        if ($this->newImg) {
            if ($user->img) {
                Storage::delete($user->img);
                $img = $this->newImg->store('img/olahraga');
            } else {
                $img = $this->newImg->store('img/olahraga');
            }
        } else {
            $img = null;
        }

        $user->update([
            'img' => $img,
            'nama' => $this->nama,
            'phone' => $this->phone,
            'telp' => $this->telp,
            'fax' => $this->fax,
            'email' => $this->email,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'alamat' => $this->alamat,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an,
            'npwp' => $this->npwp,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

        $storage = Storage::disk('public');
        if ($storage) {
            foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
                $storage->delete($filePathname);
            }
        }
    }

    public $titip_uang_page = false;
    public $titip_id_supplier, $titip_nama_supplier;
    public function titip_uang_page($supplier_id)
    {
        $supp = Supplier::find($supplier_id);
        $this->titip_id_supplier = $supp->id;
        $this->titip_nama_supplier = $supp->nama;


        if ($this->titip_uang_page == true) {
            $this->titip_uang_page = false;
        }else{
            $this->titip_uang_page = true;
        }
    }

    public function resetTitipUang()
    {
        $this->titip_id_supplier = null;
        $this->titip_nama_supplier = null;
        $this->nominal_titip_uang = null;
        $this->titip_kas_id = null;
    }

    public $titip_kas_id, $nominal_titip_uang;

    public function titip_uang()
    {

        $kas = Kas::find($this->titip_kas_id);
        $supp = Supplier::find($this->titip_id_supplier);
        // cek kas apakah cukup, jika kas lebih banyak dari jumlah titip kas
        if ($kas->saldo >= $this->nominal_titip_uang) {
            // jalan kan query
            // jika titip uang, saldo titip uang usaha bertambah
            $supp->update([
                'titip_uang_usaha' => $supp->titip_uang_usaha + $this->nominal_titip_uang
            ]);
            // pilih saldo kas, dan saldo kas berkurang
            $jenis_keluar = KasTJenis::where('nama', 'keluar')->first();
            $kategori = KasTKategori::where('nama', 'titip uang')->first();
            $trx = KasTransaksi::create([
                'kas_t_jenis_id' => $jenis_keluar->id,
                'kas_t_kategori_id' => $kategori->id,
                'kas_id' => $this->titip_kas_id,
                'nominal' => $this->nominal_titip_uang,
                'user_id' => auth()->user()->id,
            ]);

            $kas->update([
                'saldo' => $kas->saldo - $this->nominal_titip_uang,
            ]);
            $this->resetTitipUang();
            $this->titip_uang_page = false;
            $this->emit('success', ['pesan' => 'titip uang berhasil dibuat']);
        }else{
            $this->emit('error', ['pesan' => 'saldo kas tidak cukup']);
        }


    }
}
