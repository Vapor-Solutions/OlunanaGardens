<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuItem;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.menus.index', [
            'menuItems' => MenuItem::orderBy('price', 'DESC')->paginate(10),
        ]);
    }
}
