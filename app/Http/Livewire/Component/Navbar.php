<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.component.navbar');
    }

    public function darkmode($url)
    {

        if (session('darkmode') == true) {
            session()->put('darkmode', false);
            return redirect()->to($url);
        }else {
            session()->put('darkmode', true);
            return redirect()->to($url);
        }
    }
}
