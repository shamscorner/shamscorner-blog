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
                <a class="slider-category" href="#">
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
    
                            <a class="avatar" href="#">
                                <img src="{{ asset('img/user.png') }}" 
                                alt="{{ $posts[$i]->user->name }}">
                            </a>
    
                            <div class="blog-info">
    
                                <h4 class="title">
                                    <a href="#">
                                        <b>{!! $posts[$i]->body !!}</b>
                                    </a>
                                </h4>
    
                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                    <a href="#">
                                        <b>{{ $posts[3]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! $posts[3]->body !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="#">
                                        <img src="{{ asset('img/user.png') }}" 
                                        alt="{{ $posts[3]->user->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[3]->user->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[3]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
    
                            <a class="avatar" href="#">
                                <img src="{{ asset('img/user.png') }}" 
                                alt="{{ $posts[4]->user->name }}">
                            </a>
    
                            <h4 class="title">
                                <a href="#">
                                    <b>{{ $posts[4]->title }}</b>
                                </a>
                            </h4>
    
                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                    <a href="#">
                                        <b>{{ $posts[5]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! $posts[5]->body !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="#">
                                        <img src="{{ asset('img/user.png') }}" 
                                        alt="{{ $posts[4]->user->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[5]->user->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[5]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
    
                            <a class="avatar" href="#">
                                <img src="{{ asset('img/user.png') }}" 
                                alt="{{ $posts[6]->user->name }}">
                            </a>
    
                            <h4 class="title">
                                <a href="#">
                                    <b>{{ $posts[6]->title }}</b>
                                </a>
                            </h4>
    
                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                    <a href="#">
                                        <b>{{ $posts[$i]->title }}</b>
                                    </a>
                                </h4>
                            </div>
    
                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                    <a href="#">
                                        <b>{{ $posts[$i]->title }}</b>
                                    </a>
                                </h4>
                            </div>
    
                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                    <a href="#">
                                        <b>{{ $posts[11]->title }}</b>
                                    </a>
                                </h4>
    
                                <p>{!! $posts[11]->body !!}</p>
    
                                <div class="avatar-area">
                                    <a class="avatar" href="#">
                                        <img src="{{ asset('img/user.png') }}" 
                                        alt="{{ $posts[11]->user->name }}">
                                    </a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $posts[11]->user->name }}</b></a>
                                        <h6 class="date" href="#">{{ $posts[11]->updated_at }}</h6>
                                    </div>
                                </div>
    
                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
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

                        <a class="avatar" href="#">
                            <img src="{{ asset('img/user.png') }}" 
                            alt="{{ $post->user->name }}">
                        </a>

                        <div class="blog-info">

                            <h4 class="title">
                                <a href="#">
                                    <b>{!! $post->body !!}</b>
                                </a>
                            </h4>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            
            @endif

        </div><!-- row -->

        <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')

@endpush