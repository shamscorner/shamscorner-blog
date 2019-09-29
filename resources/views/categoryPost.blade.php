@extends('layouts.frontend.app')

@section('title', 'Category | Posts')

@push('css')
<link href="{{ asset('frontend/css/category/styles.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/category/responsive.css') }}" rel="stylesheet">

<style>
    .slider {
        background-image: url("{{ asset('/storage/categories/sliders/'. $category->image) }}")
    }
</style>
@endpush

@section('content')

<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
</div>

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @if ($posts->count())
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image">
                            <img src="{{ asset('/storage/posts/'. $post->image) }}" 
                                alt="{{ $post->title }}">
                        </div>

                        <a class="avatar" href="#">
                            <img src="{{ asset('/storage/profiles/'. $post->user->image) }}" 
                                alt="{{ $post->user->name }}">
                        </a>

                        <div class="blog-info">

                            <h4 class="title">
                                <a href="{{ route('post.details', $post->slug) }}">
                                    <b>{{ $post->title }}</b>
                                </a>
                            </h4>

                            <ul class="post-footer">
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
                                <li><a href="javascript:void(0);">
                                    <i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            @else
            <div class="text-center w-100 mb-5 mt-4">
                <h1 class="text-center">No Post available in this category.</h1>
            </div>
            @endif

        </div><!-- row -->

        <!-- for pagination -->
        {{ $posts->links() }}

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')
    
@endpush    