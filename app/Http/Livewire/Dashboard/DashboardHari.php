<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Kas\Kas;
use Livewire\Component;

class DashboardHari extends Component
{

    public $date;


    public function render()
    {
        $this->kasSaldo = Kas::get();
        return view('livewire.dashboard.dashboard-hari');
    }
}
