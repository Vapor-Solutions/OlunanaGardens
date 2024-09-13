<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuItem;
use Livewire\Component;

class Index extends Component
{
    public $menuItems = [];

    function mount()
    {
        $this->menuItems = MenuItem::orderBy('price', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.admin.menus.index');
    }
}
