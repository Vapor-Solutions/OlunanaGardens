<?php

namespace App\Livewire\Admin\Menus;

use App\Models\MenuItem;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    protected $listeners = [
        'done' => 'render'
    ];
    function delete($id)
    {
        MenuItem::find($id)->delete();
        $this->emit('done', [
            "success" => "Successfully Deleted this Menu Item"
        ]);
    }
    public function render()
    {
        return view('livewire.admin.menus.index', [
            'menuItems' => MenuItem::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
