<div>
    <x-slot:header>Blog Posts</x-slot:header>

    <div class=" row">
        @foreach ($blogPosts as $post)
            <div class="col-md-3 col-6">
                <div class="card" style="">
                    <img src="{{ asset($post->blog_photo_path) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {!! Str::limit($post->content, 100) !!}
                        </p>
                        <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $blogPosts->links() }}
</div>
