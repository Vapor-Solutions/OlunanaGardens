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
        'post.category' => 'required',
        'post.title' => 'required',
        'post.content' => 'required',
        // 'headerPhoto' => 'required|image|max:2048',
        'headerPhoto' => 'required|image',
        // 'blogPhoto' => 'required|image|max:2048|dimensions:ratio=3/4',
        'blogPhoto' => 'required|image',
    ];

    function mount()
    {
        $this->post = new Post();
        $this->categories = PostCategory::all();
    }

    public function save()
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

        dd('hello');
        $this->post->save();
        $this->dispatch('done', success: 'Successfully added a new Blog');
        $this->resetInput();
    }

    public function resetInput(){
        $this->post = new Post();
    }
    public function render()
    {
        return view('livewire.admin.blog-posts.create');
    }
}
