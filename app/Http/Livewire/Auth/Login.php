<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $phone, $password;

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.app')->section('content');
    }

    public function login()
    {
        $this->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $akun = User::where('phone', $this->phone)->first();

        if ($akun) {
            $cekpass = Hash::check($this->password, $akun->password);
            if ($cekpass) {
                if ($akun->isaktif == true) {
                    auth()->login($akun, true);
                    return redirect()->to('/');
                }else {
                    $this->emit('error', ['pesan' => 'Akun tidak aktif']);
                }
            }else {
                $this->emit('error', ['pesan' => 'Password salah']);
            }
        }else {
            $this->emit('error', ['pesan' => 'Nomor HP salah']);
        }
    }

}

