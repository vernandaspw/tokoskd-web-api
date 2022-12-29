<?php

namespace App\Http\Livewire\Akun;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Akun extends Component
{
    public $akun = [];

    public $take = 10;

    public $tambahPage = false, $editPage = false;

    public $nama, $phone, $email, $password, $role, $isaktif;

    public $ID;

    public function render()
    {
        $this->akun = User::latest()->take($this->take)->get();

        return view('livewire.akun.akun')->extends('layouts.app')->section('content');
    }

    public function next()
    {
        $this->take += 10;
    }

    public function aktifkan($id)
    {
        User::find($id)->update([
            'isaktif' => true,
        ]);
    }

    public function nonaktifkan($id)
    {
        User::find($id)->update([
            'isaktif' => false,
        ]);
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
            'phone' => 'required|unique:users,phone',
            'email' => 'unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'nama' => $this->nama,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'isaktif' => true,
        ]);

        $this->resetData();

        $this->emit('success', ['pesan' => 'Berhasil buat akun']);
    }

    // EDIT
    public function editPage($id)
    {
        $user = User::find($id);
        $this->ID = $user->id;
        $this->nama = $user->nama;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->isaktif = $user->isaktif;
        $this->editPage = true;
    }

    public function resetData()
    {
        $this->ID = null;
        $this->nama = null;
        $this->phone = null;
        $this->email = null;
        $this->password = null;
        $this->role = null;
        $this->isaktif = null;
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
            'nama' => $this->nama,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password == null ? $user->password : Hash::make($this->password),
            'role' => $this->role,
            'isaktif' => $this->isaktif,
        ]);

        $this->resetData();
        $this->editPage = false;
        $this->emit('success', ['pesan' => 'Berhasil ubah akun']);
    }
}
