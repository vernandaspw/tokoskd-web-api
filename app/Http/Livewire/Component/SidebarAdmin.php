<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class SidebarAdmin extends Component
{
    public function render()
    {
        return view('livewire.component.sidebar-admin');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->to('login');
    }
}
