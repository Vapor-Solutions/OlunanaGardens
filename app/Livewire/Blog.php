<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    function paginationView() {
        return 'blog-paginator';
    }
    public function render()
    {
        return view('livewire.blog',[
            'posts'=>Post::orderBy('created_at')->paginate(6)
        ])->layout('layouts.front');
    }
}
