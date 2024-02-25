<?php

namespace App\Livewire\Admin\BlogPosts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'done' => 'render'
    ];
    function delete($id)
    {
        Post::find($id)->delete();

        $this->emit('done', [
            'success' => 'Successfully Deleted Blog Post No.' . $id
        ]);
    }

    public function render()
    {
        return view('livewire.admin.blog-posts.index', [
            'blogPosts' => Post::orderBy('created_at','DESC')->paginate(8)
        ]);
    }
}
