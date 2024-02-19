<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPost extends Component
{
    public $post;

    function mount($id)
    {
        $this->post = Post::find($id);
    }
    public function render()
    {
        return view('livewire.blog-post', [
            'post' => $this->post
        ])->layout('layouts.front');
    }
}
