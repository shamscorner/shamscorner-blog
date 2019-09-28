@extends('layouts.frontend.app')

@section('title', 'Post Details')

@push('css')
<link href="{{ asset('frontend/css/single-post/styles.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/single-post/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <img class="img-fluid mb-2" 
                        src="{{ asset('/storage/posts/'. $post->image) }}" 
                        alt="{{ $post->title }}">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#">
                                    <img src="{{ asset('/storage/profiles/'. $post->user->image) }}" 
                                    alt="{{ $post->user->name }}">
                                </a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date">on {{ $post->created_at->diffForHumans() }}</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title">
                            <a href="#"><b>{{ $post->title }}</b></a>
                        </h3>

                        <div class="para">
                            {!! html_entity_decode($post->body) !!}
                        </div>

                        <ul class="tags">
                            @foreach ($post->tags as $tag)
                                <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li>
                                @guest
                                <a href="javascript:void(0);" onclick="showToast()">
                                    <i class="ion-heart"></i>
                                    {{ $post->favorite_to_users->count() }}
                                </a>
                                @else 
                                <a href="javascript:void(0);" 
                                    onclick="submitForm('favorite-form-{{ $post->id }}')">
                                    <i 
                                    class="ion-heart {{ $post->favorite_to_users()->where('user_id', Auth::user()->id)->count() ? ' text-danger' : '' }}"
                                    ></i>
                                    {{ $post->favorite_to_users->count() }}
                                </a>
                                <form id="favorite-form-{{ $post->id }}" 
                                    method="POST" 
                                    action="{{ route('post.favorite', $post->id) }}"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endguest
                            </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{{ $post->user->about }}</p>
                    </div>

                    <div class="sidebar-area subscribe-area">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form action="{{ route('subscriber.store') }}" method="POST">
                                @csrf
                                <input class="email-input" type="text" placeholder="Enter your email" name="email">
                                <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>CATEGORY CLOUD</b></h4>
                        <ul>
                            @foreach ($post->categories as $categories)
                                <li><a href="#">{{ $categories->name }}</a></li>
                            @endforeach
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">

            @foreach ($randomPosts as $randomPost)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image">
                            <img src="{{ asset('/storage/posts/'. $randomPost->image) }}" 
                            alt="{{ $randomPost->title }}">
                        </div>

                        <a class="avatar" href="#">
                            <img src="{{ asset('/storage/profiles/'. $randomPost->user->image) }}" 
                            alt="Profile Image">
                        </a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{ route('post.details', $randomPost->slug) }}"><b>{{ $randomPost->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="showToast()">
                                        <i class="ion-heart"></i>
                                        {{ $randomPost->favorite_to_users->count() }}
                                    </a>
                                    @else 
                                    <a href="javascript:void(0);" 
                                        onclick="submitForm('favorite-form-{{ $randomPost->id }}')">
                                        <i 
                                        class="ion-heart {{ $randomPost->favorite_to_users()->where('user_id', Auth::user()->id)->count() ? ' text-danger' : '' }}"
                                        ></i>
                                        {{ $randomPost->favorite_to_users->count() }}
                                    </a>
                                    <form id="favorite-form-{{ $randomPost->id }}" 
                                        method="POST" 
                                        action="{{ route('post.favorite', $randomPost->id) }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                    </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $randomPost->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-md-6 col-sm-12 --> 
            @endforeach

        </div><!-- row -->

    </div><!-- container -->
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                    <p class="text-danger">
                        Please login to comment.
                        <a href="{{ route('login') }}" class="text-primary">Click Here</a>
                    </p>
                    @else
                    <form method="POST" action="{{ route('comment.store', $post->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea rows="2" 
                                    class="text-area-messge form-control"
                                    placeholder="Enter your comment" 
                                    aria-required="true" 
                                    aria-invalid="false"
                                    name="comment"
                                    required></textarea >
                            </div><!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div><!-- col-sm-12 -->

                        </div><!-- row -->
                    </form>
                    @endguest
                </div><!-- comment-form -->

                <h4><b>COMMENTS({{ $post->comments->count() }})</b></h4>

                <div class="commnets-area ">

                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#">
                                        <img src="{{ asset('/storage/profiles/'. $comment->user->image) }}" 
                                        alt="{{ $comment->user->name }}">
                                    </a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                    <h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p>{{ $comment->comment }}</p>

                        </div>
                        @endforeach

                    @else 
                    <p>No comment yet. Be the first one :)</p>
                    @endif

                </div><!-- commnets-area -->

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection

@push('js')
    
@endpush    