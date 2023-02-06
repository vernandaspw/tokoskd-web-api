<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class SidebarStaff extends Component
{
    public function render()
    {
        return view('livewire.component.sidebar-staff');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->to('login');
    }
}
