<?php

namespace App\Livewire\Admin\BlogPosts;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public Post $post;
    public $categories;
    public $headerPhoto, $blogPhoto;

    protected $rules = [
        'post.category' => 'required',
        'post.title' => 'required',
        'post.content' => 'required',
        'headerPhoto' => 'image|max:2048',
        'blogPhoto' => 'image|max:2048|dimensions:ratio=3/4',
    ];

    function mount($id)
    {
        $this->post = Post::find($id);
        $this->categories = PostCategory::all();
    }

    function save()
    {
        $this->validate();

        $this->post->user_id = auth()->user()->id;
        $timestamp = Carbon::now()->timestamp;

        $headername = $timestamp . '.' . $this->headerPhoto->extension();
        $thumbname = $timestamp . '.' . $this->blogPhoto->extension();
        $this->headerPhoto->storeAs('blog/header_photos', $headername);
        $this->blogPhoto->storeAs('blog/thumbnails', $thumbname);
        $this->post->blog_photo_path = 'blog/thumbnails/' . $thumbname;
        $this->post->header_photo_path = 'blog/header_photos/' . $headername;
        $this->post->slug = Str::slug($this->post->title, '-');
    }
    public function render()
    {
        return view('livewire.admin.blog-posts.edit');
    }
}
