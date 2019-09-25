@extends('layouts.backend.app')

@section('title', 'Tag')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" 
rel="stylesheet">
@endpush

@section('content')
<!-- Exportable Table -->
<div class="container-fluid">

    <div class="block-header text-right">
        <a 
        href="{{ route('admin.tag.create') }}" 
        class="btn btn-primary waves-effect"
        >
            <i class="material-icons">add</i>
            <span>Add new tag</span>
        </a>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL TAGS
                        <span class="badge bg-red">{{ $tags->count() }}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Count</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Posts</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Count</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Posts</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tags as $key=>$tag)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->posts->count() }}</td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>{{ $tag->updated_at }}</td>
                                        <td>
                                            <a 
                                            href="{{ route('admin.tag.edit', $tag->id) }}"
                                            class="btn btn-xs btn-info waves-effect"
                                            >
                                                <i class="material-icons">edit</i>
                                                <span>Edit</span>
                                            </a>
                                            <button 
                                            href="{{ route('admin.tag.destroy', $tag->id) }}"
                                            class="btn btn-xs btn-danger waves-effect"
                                            type="button"
                                            onclick="deleteDialog({{ $tag->id }})"
                                            >
                                                <i class="material-icons">delete</i>
                                                <span>Delete</span>
                                            </button>
                                            <form id="delete-form-{{ $tag->id }}" action="{{ route('admin.tag.destroy', $tag->id) }}" 
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