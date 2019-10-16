@extends('layouts.frontend.app')

@section('title', 'Home')

@push('css')
<link href="{{ asset('frontend/css/home/styles.css') }}" rel="stylesheet">

<link href="{{ asset('frontend/css/home/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach ($categories as $category)
            <div class="swiper-slide">
                <a class="slider-category" href="{{ route('category.posts', $category->slug) }}">
                    <div class="blog-image">
                        <img src="{{ asset('storage/categories/sliders/'.$category->image) }}" 
                        alt="{{ $category->name }}">
                    </div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>{{ $category->name }}</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->
            @endforeach

        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->
</div><!-- slider -->
        
<section class="blog-area section">
    <div class="container">

        <div class="row">

            @if (count($posts) == 12)
                @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                           
                            <div class="blog-image">
                                <img src="{{ asset('storage/posts/'. $posts[$i]->image) }}" 
                                alt="{{ $posts[$i]->title }}">
                            </div>
    
                            <a class="avatar" href="{{ route('author.profile', $posts[$i]->username) }}">
                                <img src="{{ asset('storage/profiles/'. $posts[$i]->profile) }}" 
                                alt="{{ $posts[$i]->name }}">
                            </a>
    
                            <div class="blog-info">
    
                                <h4 class="title">
                                    <a href="{{ route('post.details', $posts[$i]->slug) }}">
                                        <b>{{ $posts[$i]->title }}</b>
                                    </a>
                                </h4>
    
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="showToast()">
                                            <i class="ion-heart"></i>
                                            {{ $posts[$i]->count_favorite_post }}
                                        </a>
                                        @else 
                                        <a href="javascript:void(0);" 
                                            onclick="submitForm('favorite-form-{{ $posts[$i]->id }}')">
                                            <i 
                                            class="ion-heart {{ $favorite_posts->contains([$posts[$i]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                            ></i>
                                            {{ $posts[$i]->count_favorite_post }}
                                        </a>
                                        <form id="favorite-form-{{ $posts[$i]->id }}" 
                                            method="POST" 
                                            action="{{ route('post.favorite', $posts[$i]->id) }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                                    </li>
                                    <li><a href="javascript:void(0);">
                                        <i class="ion-chatbubble"></i>{{ $posts[$i]->count_comments }}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[$i]->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endfor
        
                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">
    
                            <div class="blog-image">
                                <img src="{{ asset('storage/posts/'. $posts[3]->image) }}" 
                                alt="{{ $posts[3]->title }}">
                            </div>
    
                            <div class="blog-info">
    
                                <h6 class="pre-title"><a href="#"><b>HEALTH</b></a></h6>
    
                                <h4 class="title">
                                    <a href="{{ route('post.details', $posts[3]->slug) }}">
                                        <b>{{ $posts[3]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! Str::limit($posts[3]->body, '150') !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="{{ route('author.profile', $posts[3]->username) }}">
                                        <img src="{{ asset('storage/profiles/'. $posts[3]->profile) }}" 
                                        alt="{{ $posts[3]->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[3]->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[3]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="showToast()">
                                            <i class="ion-heart"></i>
                                            {{ $posts[3]->count_favorite_post }}
                                        </a>
                                        @else 
                                        <a href="javascript:void(0);" 
                                            onclick="submitForm('favorite-form-{{ $posts[3]->id }}')">
                                            <i 
                                            class="ion-heart {{ $favorite_posts->contains([$posts[3]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                            ></i>
                                            {{ $posts[3]->count_favorite_post }}
                                        </a>
                                        <form id="favorite-form-{{ $posts[3]->id }}" 
                                            method="POST" 
                                            action="{{ route('post.favorite', $posts[3]->id) }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                                    </li>
                                    <li><a href="javascript:void(0);">
                                        <i class="ion-chatbubble"></i>{{ $posts[3]->count_comments }}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[3]->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-right -->
    
                        </div><!-- single-post extra-blog -->
    
                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->
        
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
    
                            <div class="blog-image">
                                    <img src="{{ asset('storage/posts/'. $posts[4]->image) }}" 
                                    alt="{{ $posts[4]->title }}">
                            </div>
    
                            <a class="avatar" href="{{ route('author.profile', $posts[4]->username) }}">
                                <img src="{{ asset('storage/profiles/'. $posts[4]->profile) }}" 
                                alt="{{ $posts[4]->name }}">
                            </a>
    
                            <h4 class="title">
                                <a href="{{ route('post.details', $posts[4]->slug) }}">
                                    <b>{{ $posts[4]->title }}</b>
                                </a>
                            </h4>
    
                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="showToast()">
                                        <i class="ion-heart"></i>
                                        {{ $posts[4]->count_favorite_post }}
                                    </a>
                                    @else 
                                    <a href="javascript:void(0);" 
                                        onclick="submitForm('favorite-form-{{ $posts[4]->id }}')">
                                        <i 
                                        class="ion-heart {{ $favorite_posts->contains([$posts[4]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                        ></i>
                                        {{ $posts[4]->count_favorite_post }}
                                    </a>
                                    <form id="favorite-form-{{ $posts[4]->id }}" 
                                        method="POST" 
                                        action="{{ route('post.favorite', $posts[4]->id) }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="javascript:void(0);">
                                    <i class="ion-chatbubble"></i>{{ $posts[4]->count_comments }}</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[4]->view_count }}</a></li>
                            </ul>
    
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
        
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
    
                        <div class="single-post post-style-2 post-style-3">
    
                            <div class="blog-info">
    
                                <h6 class="pre-title"><a href="#"><b>HEALTH</b></a></h6>
    
                                <h4 class="title">
                                    <a href="{{ route('post.details', $posts[5]->slug) }}">
                                        <b>{{ $posts[5]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! Str::limit($posts[5]->body, '150') !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="{{ route('author.profile', $posts[5]->username) }}">
                                        <img src="{{ asset('storage/profiles/'. $posts[5]->profile) }}" 
                                        alt="{{ $posts[4]->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[5]->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[5]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="showToast()">
                                            <i class="ion-heart"></i>
                                            {{ $posts[5]->count_favorite_post }}
                                        </a>
                                        @else 
                                        <a href="javascript:void(0);" 
                                            onclick="submitForm('favorite-form-{{ $posts[5]->id }}')">
                                            <i 
                                            class="ion-heart {{ $favorite_posts->contains([$posts[5]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                            ></i>
                                            {{ $posts[5]->count_favorite_post }}
                                        </a>
                                        <form id="favorite-form-{{ $posts[5]->id }}" 
                                            method="POST" 
                                            action="{{ route('post.favorite', $posts[5]->id) }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                                    </li>
                                    <li><a href="javascript:void(0);">
                                        <i class="ion-chatbubble"></i>{{ $posts[5]->count_comments }}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[5]->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-right -->
    
                        </div><!-- single-post extra-blog -->
    
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
        
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image">
                                <img src="{{ asset('storage/posts/'. $posts[6]->image) }}" 
                                alt="{{ $posts[6]->title }}">
                            </div>
    
                            <a class="avatar" href="{{ route('author.profile', $posts[6]->username) }}">
                                <img src="{{ asset('storage/profiles/'. $posts[6]->profile) }}" 
                                alt="{{ $posts[6]->name }}">
                            </a>
    
                            <h4 class="title">
                                <a href="{{ route('post.details', $posts[6]->slug) }}">
                                    <b>{{ $posts[6]->title }}</b>
                                </a>
                            </h4>
    
                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="showToast()">
                                        <i class="ion-heart"></i>
                                        {{ $posts[6]->count_favorite_post }}
                                    </a>
                                    @else 
                                    <a href="javascript:void(0);" 
                                        onclick="submitForm('favorite-form-{{ $posts[6]->id }}')">
                                        <i 
                                        class="ion-heart {{ $favorite_posts->contains([$posts[6]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                        ></i>
                                        {{ $posts[6]->count_favorite_post }}
                                    </a>
                                    <form id="favorite-form-{{ $posts[6]->id }}" 
                                        method="POST" 
                                        action="{{ route('post.favorite', $posts[6]->id) }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="javascript:void(0);">
                                    <i class="ion-chatbubble"></i>{{ $posts[6]->count_comments }}</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[6]->view_count }}</a></li>
                            </ul>
    
                        </div><!-- single-post -->
    
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
        
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
    
                        @for ($i = 7; $i < 9; $i++)
                        <div class="single-post post-style-4">
    
                            <div class="display-table">
                                <h4 class="title display-table-cell">
                                    <a href="{{ route('post.details', $posts[$i]->slug) }}">
                                        <b>{{ $posts[$i]->title }}</b>
                                    </a>
                                </h4>
                            </div>
    
                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="showToast()">
                                        <i class="ion-heart"></i>
                                        {{ $posts[$i]->count_favorite_post }}
                                    </a>
                                    @else 
                                    <a href="javascript:void(0);" 
                                        onclick="submitForm('favorite-form-{{ $posts[$i]->id }}')">
                                        <i 
                                        class="ion-heart {{ $favorite_posts->contains([$posts[$i]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                        ></i>
                                        {{ $posts[$i]->count_favorite_post }}
                                    </a>
                                    <form id="favorite-form-{{ $posts[$i]->id }}" 
                                        method="POST" 
                                        action="{{ route('post.favorite', $posts[$i]->id) }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="javascript:void(0);">
                                    <i class="ion-chatbubble"></i>{{ $posts[$i]->count_comments }}</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[$i]->view_count }}</a></li>
                            </ul>
    
                        </div><!-- single-post -->
                        @endfor
    
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
        
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
    
                        @for ($i = 9; $i < 11; $i++)
                        <div class="single-post post-style-4">
    
                            <div class="display-table">
                                <h4 class="title display-table-cell">
                                    <a href="{{ route('post.details', $posts[$i]->slug) }}">
                                        <b>{{ $posts[$i]->title }}</b>
                                    </a>
                                </h4>
                            </div>
    
                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="showToast()">
                                        <i class="ion-heart"></i>
                                        {{ $posts[$i]->count_favorite_post }}
                                    </a>
                                    @else 
                                    <a href="javascript:void(0);" 
                                        onclick="submitForm('favorite-form-{{ $posts[$i]->id }}')">
                                        <i 
                                        class="ion-heart {{ $favorite_posts->contains([$posts[$i]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                        ></i>
                                        {{ $posts[$i]->count_favorite_post }}
                                    </a>
                                    <form id="favorite-form-{{ $posts[$i]->id }}" 
                                        method="POST" 
                                        action="{{ route('post.favorite', $posts[$i]->id) }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="javascript:void(0);">
                                    <i class="ion-chatbubble"></i>{{ $posts[$i]->count_comments }}</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[$i]->view_count }}</a></li>
                            </ul>
    
                        </div><!-- single-post -->
                        @endfor
    
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
        
                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">
    
                            <div class="blog-image">
                                <img src="{{ asset('storage/posts/'. $posts[11]->image) }}" 
                                alt="{{ $posts[11]->title }}">
                            </div>
    
                            <div class="blog-info">
    
                                <h6 class="pre-title"><a href="#"><b>HEALTH</b></a></h6>
    
                                <h4 class="title">
                                    <a href="{{ route('post.details', $posts[11]->slug) }}">
                                        <b>{{ $posts[11]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! Str::limit($posts[11]->body, '150') !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="{{ route('author.profile', $posts[11]->username) }}">
                                        <img src="{{ asset('storage/profiles/'. $posts[11]->profile) }}" 
                                        alt="{{ $posts[11]->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[11]->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[11]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="showToast()">
                                            <i class="ion-heart"></i>
                                            {{ $posts[11]->count_favorite_post }}
                                        </a>
                                        @else 
                                        <a href="javascript:void(0);" 
                                            onclick="submitForm('favorite-form-{{ $posts[11]->id }}')">
                                            <i 
                                            class="ion-heart {{ $favorite_posts->contains([$posts[11]->id => Auth::user()->id]) ? ' text-danger' : '' }}"
                                            ></i>
                                            {{ $posts[11]->count_favorite_post }}
                                        </a>
                                        <form id="favorite-form-{{ $posts[11]->id }}" 
                                            method="POST" 
                                            action="{{ route('post.favorite', $posts[11]->id) }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endguest
                                    </li>
                                    <li><a href="javascript:void(0);">
                                        <i class="ion-chatbubble"></i>{{ $posts[11]->count_comments }}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $posts[11]->view_count }}</a></li>
                                </ul>
    
                            </div><!-- blog-right -->
    
                        </div><!-- single-post extra-blog -->
    
                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->
            @else
            
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        
                        <div class="blog-image">
                            <img src="{{ asset('storage/posts/'. $post->image) }}" 
                            alt="{{ $post->title }}">
                        </div>

                        <a class="avatar" href="{{ route('author.profile', $post->username) }}">
                            <img src="{{ asset('storage/profiles/'. $post->profile) }}" 
                            alt="{{ $post->name }}">
                        </a>

                        <div class="blog-info">

                            <h4 class="title">
                                <a href="{{ route('post.details', $post->slug) }}">
                                    <b>{{ $post->title }}</b>
                                </a>
                            </h4>

                            <ul class="post-footer">

                                @guest
                                <li><i class="ion-heart"></i>{{ $post->count_favorite_post }}/li>
                                <li><i class="ion-chatbubble"></i>{{ $post->count_comments }}</li>
                                <li><i class="ion-eye"></i>{{ $post->view_count }}</li>
                                @else
                                <li><a href="javascript:void(0);"><i class="ion-heart {{ $favorite_posts->contains([$post->id => Auth::user()->id]) ? ' text-danger' : '' }}"></i>{{ $post->count_favorite_post }}</a></li>
                                <li><a href="javascript:void(0);"><i class="ion-chatbubble"></i>{{ $post->count_comments }}</a></li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                @endguest
                                
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            
            @endif

        </div><!-- row -->

        <a class="load-more-btn" href="{{ route('post.index') }}"><b>VIEW MORE</b></a>

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')

@endpush