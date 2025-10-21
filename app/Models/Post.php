<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'blog_photo_path',
        'header_photo_path',
        'published_at',
        'status',
    ];

    protected $appends = ['blog_photo_url', 'header_photo_url'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function getBlogPhotoUrlAttribute()
    {
        if(file_exists(public_path($this->blog_photo_path))) {
            return asset($this->blog_photo_path);
        }
        return asset('https://placehold.co/900x1200');
    }
    public function getHeaderPhotoUrlAttribute()
    {
        if(file_exists(public_path($this->header_photo_path))) {
            return asset($this->header_photo_path);
        }
        return asset('https://placehold.co/1920x1080');
    }
}
