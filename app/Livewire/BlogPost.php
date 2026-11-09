<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.front')]
class BlogPost extends Component
{
    public $post;

    public function mount($slug)
    {
        // A missing slug is a real 404, not a half-rendered page.
        $this->post = Post::with('author')->where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $plain = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $this->post->content))));

        $layoutData = ['ogType' => 'article'];

        if ($plain !== '') {
            $layoutData['metaDescription'] = Str::limit($plain, 155);
        }

        if ($this->post->blog_photo_path && file_exists(public_path($this->post->blog_photo_path))) {
            $layoutData['ogImage'] = config('seo.canonical_base') . '/' . ltrim($this->post->blog_photo_path, '/');
        }

        return view('livewire.blog-post')
            ->title($this->post->title . ' | ' . config('seo.site_name'))
            ->layoutData($layoutData);
    }
}
