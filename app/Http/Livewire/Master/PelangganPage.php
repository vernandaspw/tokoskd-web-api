<?php

namespace App\Http\Livewire\Master;

use App\Models\Pelanggan;
use Livewire\Component;
use Livewire\WithFileUploads;

class PelangganPage extends Component
{
    use WithFileUploads;

    public $akun = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $ID;
    public $img, $nama, $jk, $daerah, $alamat, $phone, $email, $bank, $norek, $an;
    public $newImg;

    public function render()
    {
        $this->akun = Pelanggan::latest()->take($this->take)->get();
        return view('livewire.master.pelanggan-page')->extends('layouts.app')->section('content');
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


        // if ($this->img) {
        //     $img = $this->img->store('img/olahraga');
        // } else {
        //     $img = null;
        // }

        Pelanggan::create([
            'nama' => $this->nama,
            'jk' => $this->jk,
            'daerah' => $this->daerah,
            'alamat' => $this->alamat,
            'phone' => $this->phone,
            'email' => $this->email,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an
        ]);

        $this->resetData();

        $this->emit('success', ['pesan' => 'Berhasil simpan data']);

        // $storage = Storage::disk('public');
        // if ($storage) {
        //     foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
        //         $storage->delete($filePathname);
        //     }
        // }
    }

    // EDIT
    public function editPage($id)
    {
        $user = Pelanggan::find($id);
        $this->ID = $user->id;
        $this->nama = $user->nama;
        $this->jk = $user->jk;
        $this->phone = $user->phone;
        $this->daerah = $user->daerah;
        $this->alamat = $user->alamat;
        $this->email = $user->email;
        $this->bank = $user->bank;
        $this->norek = $user->rekening;
        $this->an = $user->an;

        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->img = null;
        $this->nama = null;
        $this->jk = null;
        $this->phone = null;
        $this->daerah = null;
        $this->alamat = null;
        $this->email = null;
        $this->bank = null;
        $this->norek = null;
        $this->an = null;
    }

    public function editPageClose()
    {
        $this->resetData();
        $this->editPage = false;
    }

    public function edit()
    {
        $user = Pelanggan::find($this->ID);

        // if ($this->newImg) {
        //     if ($user->img) {
        //         Storage::delete($user->img);
        //         $img = $this->newImg->store('img/olahraga');
        //     } else {
        //         $img = $this->newImg->store('img/olahraga');
        //     }
        // } else {
        //     $img = null;
        // }

        $user->update([
            'nama' => $this->nama,
            'jk' => $this->jk,
            'phone' => $this->phone,
            'daerah' => $this->daerah,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'bank' => $this->bank,
            'norek' => $this->norek,
            'an' => $this->an,
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil edit data']);

        // $storage = Storage::disk('public');
        // if ($storage) {
        //     foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
        //         $storage->delete($filePathname);
        //     }
        // }
    }
}
