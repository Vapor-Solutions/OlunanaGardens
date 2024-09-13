<?php

namespace App\Livewire\Admin\MenuCategories;

use App\Models\MenuCategory;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = [
        'done' => 'render'
    ];



    function delete($id)
    {

        $category = MenuCategory::find($id);

        if (count($category->menuItems) < 1) {
            $category->delete();
            $this->emit('done', [
                "success" => "Successfully Deleted this Menu Category"
            ]);
        } else {
            # code...
            $this->emit('done', [
                "warning" => "This Category has Menu Items"
            ]);
        }
    }
    public function render()
    {
        return view('livewire.admin.menu-categories.index', [
            'menuCategories' => MenuCategory::all()
        ]);
    }
}
