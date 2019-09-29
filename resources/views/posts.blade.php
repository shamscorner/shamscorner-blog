@extends('layouts.frontend.app')

@section('title')
{{ isset($query) ? $query : 'Posts' }}
@endsection

@push('css')
<link href="{{ asset('frontend/css/category/styles.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/category/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="blog-area section">
    <div class="container">

        <div class="row">

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

        </div><!-- row -->

        <!-- for pagination -->
        {{ $posts->links() }}

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')
    
@endpush    