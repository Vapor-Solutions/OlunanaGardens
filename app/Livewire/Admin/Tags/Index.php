<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;



    public function render()
    {
        return view('livewire.admin.tags.index', [
            'tags'=> Tag::paginate(10)
        ]);
    }
}
