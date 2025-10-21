<?php

namespace App\Livewire\Admin\BlogPosts;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Post $post;
    public $categories;
    public $headerPhoto, $blogPhoto;

    protected $rules = [
        'post.post_category_id' => 'required',
        'post.title' => 'required',
        'post.content' => 'required',
        'headerPhoto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        'blogPhoto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
        $this->categories = PostCategory::all();
    }

    public function save()
    {
        $this->validate();

        $this->post->user_id = auth()->user()->id;

        // Only update photos if new ones are uploaded
        if ($this->headerPhoto) {
            $headername = Str::random(40) . '.' . $this->headerPhoto->extension();
            $this->headerPhoto->storeAs('blog/header_photos', $headername, 'public');
            $this->post->header_photo_path = 'blog/header_photos/' . $headername;
        }

        if ($this->blogPhoto) {
            $thumbname = Str::random(40) . '.' . $this->blogPhoto->extension();
            $this->blogPhoto->storeAs('blog/thumbnails', $thumbname, 'public');
            $this->post->blog_photo_path = 'blog/thumbnails/' . $thumbname;
        }

        $this->post->slug = Str::slug($this->post->title, '-');

        $this->post->save();
        $this->dispatch('done', success: 'Successfully updated the Blog Post');
        $this->redirect(route('admin.blog-posts.index'));
    }

    public function resetInput()
    {
        $this->post = new Post();
    }
    public function render()
    {
        return view('livewire.admin.blog-posts.edit');
    }
}
