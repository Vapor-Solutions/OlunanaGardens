<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4"
        data-background="{{ $post->header_photo_url }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5><a href="news.html">Blog</a> / Post Page</h5>
                    <h1>{{ $post->title }}</h1>
                    <div class="post">
                        <div class="author"> <img src="{{ $post->author->profile_photo_url }}" alt=""
                                class="avatar"> <span>{{ $post->author->name }}</span> </div>
                        <div class="date-comment"> <i class="ti-calendar"></i>
                            {{ Carbon\Carbon::parse($post->created_at)->format('jS M, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Post -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {!! $post->content !!}
                </div>
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="news2-sidebar row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h6>Recent Posts</h6>
                                </div>
                                <ul class="recent">
                                    @foreach (App\Models\Post::orderBy('created_at', 'DESC')->take(4)->get() as $item)
                                    <li>
                                        <div class="thum"> <img src="{{ $item->blog_photo_path }}" alt="">
                                        </div>
                                        <a href="{{ route('blog-post', $item->id) }}">{{ $item->title }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
