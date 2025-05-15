<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $title = 'Dashboard';
    public $meta_title = 'Dashboard';

    public function mount()
    {
        // dd(Auth::user()->roles->toArray());
    }

    public function render()
    {
        return view('livewire.home')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }
}
