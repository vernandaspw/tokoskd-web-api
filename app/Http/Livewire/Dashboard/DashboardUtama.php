<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class DashboardUtama extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard-utama')->extends('layouts.app')->section('content');
    }
}
