<?php

namespace App\Livewire\Admin\BlogPosts;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public Post $post;
    public $categories;
    public $headerPhoto, $blogPhoto;

    protected $rules = [
        'post.post_category_id' => 'required',
        'post.title' => 'required',
        'post.content' => 'required',
        'headerPhoto' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        'blogPhoto' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
    ];

    public function mount()
    {
        $this->post = new Post();
        $this->categories = PostCategory::all();
    }

    public function save()
    {
        $this->validate();

        $this->post->user_id = auth()->user()->id;

        // Generate random filenames for security
        $headername = Str::random(40) . '.' . $this->headerPhoto->extension();
        $thumbname = Str::random(40) . '.' . $this->blogPhoto->extension();

        $this->headerPhoto->storeAs('blog/header_photos', $headername, 'public');
        $this->blogPhoto->storeAs('blog/thumbnails', $thumbname, 'public');
        $this->post->blog_photo_path = 'blog/thumbnails/' . $thumbname;
        $this->post->header_photo_path = 'blog/header_photos/' . $headername;
        $this->post->slug = Str::slug($this->post->title, '-');

        $this->post->save();
        $this->dispatch('done', success: 'Successfully added a new Blog');
        $this->redirect(route('admin.blog-posts.index'));
    }

    public function resetInput()
    {
        $this->post = new Post();
    }
    public function render()
    {
        return view('livewire.admin.blog-posts.create');
    }
}
