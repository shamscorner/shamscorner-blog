@extends('layouts.backend.app')

@section('title', 'Comments')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" 
rel="stylesheet">
@endpush

@section('content')
<!-- Exportable Table -->
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL COMMENTS <span class="badge bg-red">{{ count($data) }}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Count</th>
                                    <th>Comment</th>
                                    <th>Related Post</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Count</th>
                                    <th>Comment</th>
                                    <th>Related Post</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($data as $key=>$item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="avatar" href="#">
                                                    <img class="media-object" src="{{ asset('/storage/profiles/'. $item->profile) }}" 
                                                    alt="{{ $item->name }}" width="64" height="64">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $item->name }}
                                                <small>{{ \Carbon\Carbon::parse($item->comment_date)->diffForHumans() }}</small></h4>
                                                <p>{{ $item->comment }}</p>
                                                <a href="{{ route('post.details', $item->slug. "#comments") }}">Reply</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a target="_blank" href="{{ route('post.details', $item->slug) }}">
                                                    <img class="media-object" src="{{ asset('/storage/posts/'. $item->thumbnail) }}" 
                                                    alt="{{ $item->title }}" height="64">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a target="_blank" href="{{ route('post.details', $item->slug) }}">
                                                    <h4 class="media-heading">{{ Str::limit($item->title, 40) }}</h4>
                                                </a>
                                                <p>at <strong>{{ \Carbon\Carbon::parse($item->post_date)->diffForHumans() }}</strong></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button 
                                            class="btn btn-xs btn-danger waves-effect"
                                            type="button"
                                            onclick="deleteDialog({{ $item->id }})"
                                        >
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{ $item->id }}" 
                                            action="{{ route('author.comment.destroy', $item->id) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table --> 
@endsection

@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

<script src="{{ asset('backend/js/script.js') }}"></script>
@endpush