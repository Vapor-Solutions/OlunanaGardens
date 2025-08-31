<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.front')]
class BlogPost extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->first();
    }
    public function render()
    {
        return view('livewire.blog-post', [
            'post' => $this->post
        ]);
    }
}
