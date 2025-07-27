<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuItem;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    protected $listeners = [
        'done' => 'render'
    ];
    public function delete($id)
    {
        MenuItem::find($id)->delete();
        $this->dispatch('done', success:"Successfully Deleted this Menu Item");
    }
    public function render()
    {
        return view('livewire.admin.menus.index', [
            'menuItems' => MenuItem::where('title', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
