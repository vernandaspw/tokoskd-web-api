<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Kasir;
use App\Models\Kas\Kas;
use Livewire\Component;

class KasirPage extends Component
{
    public $createPage = false, $editPage = false;

    public $nama;

    public $editID;

    public function render()
    {
        $this->kasiractive = Kasir::where('isaktif', true)->latest()->get();

        $this->kasirdeactive = Kasir::where('isaktif', false)->latest()->get();

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
}
