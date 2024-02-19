<?php

namespace App\Livewire\Front;

use App\Models\Post;
use Livewire\Component;

class Blog extends Component
{
    public function render()
    {
        return view('livewire.front.blog', [
            'posts' => Post::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
