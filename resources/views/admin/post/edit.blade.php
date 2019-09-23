@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
<!-- Bootstrap Select Css -->
<link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Post Header
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="post_title" class="form-control" 
                                value="{{ $post->title }}"
                                name="title" required>
                                <label class="form-label">Title</label>
                            </div>
                        </div>
                        
                        <div class="form-group form-float">
                            <label class="form-label" for="post_image">Thumbnail Image</label>
                            <input type="file" id="post_image" class="form-control" name="image">
                        </div>

                        <div class="form-group form-float">
                            <input type="checkbox" id="published" class="filled-in" name="status" 
                                value="1" {{ $post->status ? ' checked' : ''}}>
                            <label class="form-label" for="published">Published</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories & Tags
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <label class="form-label" for="category_name">Select Category</label>
                            <select 
                                class="form-control show-tick @error('categories') is-invalid @enderror" 
                                id="category_name" 
                                name="categories[]" 
                                data-live-search="true"
                                required 
                                multiple
                            >
                                @foreach ($categories as $category)
                                    <option 
                                        value="{{ $category->id }}"
                                        @foreach ($post->categories as $postCategory)
                                            {{ $postCategory->id == $category->id ? ' selected' : ''}}
                                        @endforeach
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tag_name">Select Tag</label>
                            <select 
                                class="form-control show-tick @error('categories') is-invalid @enderror" 
                                id="tag_name" 
                                name="tags[]" 
                                data-live-search="true" 
                                required
                                multiple
                            >
                            @foreach ($tags as $tag)
                                <option 
                                    value="{{ $tag->id }}"
                                    @foreach ($post->tags as $postTag)
                                        {{ $postTag->id == $tag->id ? ' selected' : ''}}
                                    @endforeach
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                            </select>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Post Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="tinymce" name="body">
                            {{ $post->body }}
                        </textarea>
                        <a class="btn btn-danger m-t-15 waves-effect" 
                        href="{{ route('admin.category.index') }}"
                        >BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<!-- Select Plugin Js -->
<script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{ asset('backend/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<!-- TinyMCE -->
<script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>

<script>
jQuery(document).ready(function($) {
    // TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = "{{ asset('backend/plugins/tinymce') }}";
});
</script>
@endpush