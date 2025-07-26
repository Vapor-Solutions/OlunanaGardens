<?php

namespace App\Livewire\Admin\PostCategories;

use App\Models\Post;
use App\Models\PostCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    protected $listeners = [
        'done' => 'render'
    ];

    public function delete($id)
    {
        $post_category = PostCategory::find($id);

        $posts_with_category = Post::where('post_category_id', $post_category->id)->exists();


        if ($posts_with_category) {
            $this->dispatch('done', error: "Cannot delete " .$post_category->title. " Blog category because it has associated posts.");
        } else {
            $post_category->delete();
            $this->dispatch('done', success: "Successfully deleted " .$post_category->title.  " Blog Category");
        }
        // Post::where('post_category_id', $post_category->id)->update(['post_category_id' => null]);

    }

    public function render()
    {
        return view('livewire.admin.post-categories.index', [
            'blog_categories' => PostCategory::paginate(5)
        ]);
    }
}
