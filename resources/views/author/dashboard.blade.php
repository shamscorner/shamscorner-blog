@extends('layouts.backend.app')

@section('title', 'Dashboard')

@push('css')
    
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $posts_count }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text">FAVORITE POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $favorite_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text">PENDING POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL VIEWS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <div class="row clearfix">
        <!-- Visitors -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-pink">
                    <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                         data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                         data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                         data-fill-Color="rgba(0, 188, 212, 0)">
                        @foreach ($posts_summary_date['top_10_days_post_count'] as $item)
                            {{ $item . ',' }}
                        @endforeach
                    </div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>{{ $posts_summary_date['posts_today'] }}</b> <small>POSTS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>{{ $posts_summary_date['posts_yesterday'] }}</b> <small>POSTS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>{{ $posts_summary_date['post_last_week'] }}</b> <small>POSTS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Visitors -->
        <!-- Latest Social Trends -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-cyan">
                    <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                    <ul class="dashboard-stat-list">
                        @foreach ($trending_category as $category)
                        <li>
                            <a style="color: white;" href="{{ route('category.posts', $category->slug) }}"># {{ $category->slug }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Latest Social Trends -->
        <!-- Answered Tickets -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-teal">
                    <div class="font-bold m-b--35">VIEW HISTORY</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>{{ $views_summary_date['today'] }}</b> <small>VIEWS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>{{ $views_summary_date['yesterday'] }}</b> <small>VIEWS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>{{ $views_summary_date['last_week'] }}</b> <small>VIEWS</small></span>
                        </li>
                        <li>
                            LAST MONTH
                            <span class="pull-right"><b>{{ $views_summary_date['last_month'] }}</b> <small>VIEWS</small></span>
                        </li>
                        <li>
                            LAST YEAR
                            <span class="pull-right"><b>{{ $views_summary_date['last_year'] }}</b> <small>VIEWS</small></span>
                        </li>
                        <li>
                            ALL
                            <span class="pull-right"><b>{{ $views_summary_date['all'] }}</b> <small>VIEWS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Answered Tickets -->
    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>TRENDING POSTS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                    <th>Created_at</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($popular_posts as $key=>$post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($post->title, 30) }}</td>
                                    <td>{{ $post->view_count }}</td>
                                    <td>{{ $post->comments_count }}</td>
                                    <td>
                                        <div class="progress">
                                            <div 
                                                class="progress-bar bg-green" 
                                                role="progressbar" 
                                                aria-valuenow="{{ $post->favorite_to_users_count }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100" 
                                                style="width: 62%">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        @if($post->status)
                                            <span class="badge bg-green">Published</span>
                                        @else
                                            <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection

@push('js')
<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- Morris Plugin Js -->
<script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/morrisjs/morris.js') }}"></script>

<!-- ChartJs -->
<script src="{{ asset('backend/plugins/chartjs/Chart.bundle.js') }}"></script>

<!-- Flot Charts Plugin Js -->
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

<!-- custom js -->
<script src="{{ asset('backend/js/pages/index.js') }}"></script>  
@endpush