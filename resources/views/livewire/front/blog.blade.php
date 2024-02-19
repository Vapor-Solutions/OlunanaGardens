<div>
    <section class="news section-padding bg-blck">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-subtitle"><span>Olunana Gardens News</span></div>
                    <div class="section-title"><span>Our Blog</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (count($posts) > 0)
                        <div class="owl-carousel owl-theme">

                            @foreach ($posts as $post)
                                <div wire:key='post-{{ $post->id }}' class="item">
                                    <div class="position-re o-hidden"> <img src="{{ $post->blog_photo_path }}" alt="">
                                        <div class="date">
                                            <a href="{{ route('blog-post', $post->id) }}">
                                                <span>{{ Carbon\Carbon::parse($post->created_at)->format('M') }}</span>
                                                <i>{{ Carbon\Carbon::parse($post->created_at)->format('d') }}</i> </a>
                                        </div>
                                    </div>
                                    <div class="con"> <span class="category">
                                            {{ $post->category?->title}}
                                        </span>
                                        <h5><a href="{{ route('blog-post', $post->id) }}">{{$post->title}}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card bg-transparent border-0">
                            <h1 class="text-center text-white">No Posts Made Yet</h1>
                        </div>
                    @endif
                </div>
            </div>
    </section>
</div>
