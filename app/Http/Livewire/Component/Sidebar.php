<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.component.sidebar');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->to('login');
    }
}
