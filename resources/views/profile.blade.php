@extends('layouts.frontend.app')

@section('title')
{{ $author->name }}
@endsection

@push('css')
<link href="{{ asset('frontend/css/category-sidebar/styles.css') }}" rel="stylesheet">

<link href="{{ asset('frontend/css/category-sidebar/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="blog-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">

                    @if ($posts->count())
                    @foreach ($posts as $post)
                    <div class="col-md-6 col-sm-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image">
                                    <img src="{{ asset('storage/posts/'. $post->image) }}" alt="{{ $post->title }}">
                                </div>

                                <a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
                                    <img src="{{ asset('storage/profiles/'. $post->user->image) }}" alt="{{ $post->user->name }}">
                                </a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details', $post->slug) }}">
                                        <b>{{ $post->title }}</b></a>
                                    </h4>

                                    <ul class="post-footer">
                                        @guest
                                        <li><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}/li>
                                        <li><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</li>
                                        <li><i class="ion-eye"></i>{{ $post->view_count }}</li>
                                        @else
                                        <li><a href="javascript:void(0);"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a></li>
                                        <li><a href="javascript:void(0);"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                        @endguest
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
                    @endforeach
                    @else 
                    <h1>Sorry, no post available for this author right now. </h1>
                    @endif

                </div><!-- row -->

                <!-- for pagination -->
                {{ $posts->links() }}

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 ">

                <div class="single-post info-area ">

                    <div class="about-area">
                        <div class="card">
                            <img src="{{ asset('storage/profiles/'. $author->image) }}" 
                                class="card-img-top" alt="{{ $author->name }}">
                            <div class="card-body">
                              <h5 class="card-title text-center mt-2 font-weight-bold">{{ $author->name }}</h5>
                              <p class="card-text">{{ $author->about }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="subscribe-area">

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
                            @foreach ($categories as $category)
                                <li><a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>

                    </div><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>TAG CLOUD</b></h4>
                        <ul>
                            @foreach ($tags as $tag)
                                <li><a href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')
    
@endpush    