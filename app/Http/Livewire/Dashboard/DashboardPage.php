<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Kas\Kas;
use Livewire\Component;

class DashboardPage extends Component
{

    public $date;

    public function render()
    {
        // if ($this->date) {

        // }
        $this->kasSaldo = Kas::get();
        return view('livewire.dashboard.dashboard-page');
    }
}
