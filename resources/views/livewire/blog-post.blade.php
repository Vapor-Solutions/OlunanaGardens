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
                            {{ Carbon\Carbon::parse($post->created_at)->format('jS M, Y') }} </div>
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
                    {{-- <div class="post-comment-section">
                        <div class="row">
                            <!-- Comment -->
                            <div class="col-md-12">
                                <div class="news-post-comment-wrap">
                                    <div class="post-user-comment"> <img src="img/team/3.jpg" alt=""> </div>
                                    <div class="post-user-content">
                                        <span>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                        </span>
                                        <h3>Robert Martin<span> 29 October 2022</span></h3>
                                        <p>Restaurant ultricies nibh non dolor maximus sceleue inte molliser rana neque
                                            nec tempor. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                                        </p> <a class="post-repay" href="#">Reply<i class="ti-back-left"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Form -->
                            <div class="col-md-8 mb-30">
                                <h3 class="mb-30">Leave a Reply</h3>
                                <form method="post" class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="name" placeholder="Full Name *"
                                            required="">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" id="email"
                                            placeholder="Email Address *" required="">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="message" id="message" cols="40" rows="4" placeholder="Your Comment *" required=""></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="butn-dark2"><span>Send Comment</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="news2-sidebar row">
                        {{-- <div class="col-md-12">
                            <div class="widget search">
                                <form>
                                    <input type="text" name="search" placeholder="Type here ...">
                                    <button type="submit"><i class="ti-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div> --}}
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

                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h6>Categories</h6>
                                </div>
                                <ul>
                                    @foreach (App\Models\PostCategory::all() as $category)
                                        <li><a href="news.html"><i class="ti-angle-right"></i>{{ $category->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-title">
                                    <h6>Tags</h6>
                                </div>
                                <ul class="tags">
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Spa</a></li>
                                    <li><a href="#">Health Club</a></li>
                                    <li><a href="#">Luxury Hotel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
