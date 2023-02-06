<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class SidebarSuperadmin extends Component
{
    public function render()
    {
        return view('livewire.component.sidebar-superadmin');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->to('login');
    }
}
