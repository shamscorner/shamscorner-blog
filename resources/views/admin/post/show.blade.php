@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')

@endpush

@section('content')
<div class="container-fluid">

    <div>
        <a href="{{ route('admin.post.index') }}" class="btn btn-primary waves-effect">BACK</a>
    </div>
    <br>

    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2>
                                {{ $post->title }}
                                <small>
                                    Posted by 
                                    <strong>
                                        <a href="#">{{ $post->user->name }}</a>
                                    </strong> on {{ $post->created_at->toFormattedDateString()}}
                                </small>
                            </h2>
                        </div>
                        <div class="col-md-2 text-right">
                            @if ($post->is_approved) 
                                <button type="button" class="btn btn-success waves-effect pull-right disabled">
                                    <i class="material-icons">done</i>
                                    <span>Approved</span>
                                </button>
                            @else
                                <button type="button" class="btn btn-success waves-effect pull-right">
                                    <i class="material-icons">done</i>
                                    <span>Approve</span>
                                </button>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>
                <div class="body">
                    <div>
                        <img 
                            src="{{ Storage::disk('public')->url('posts/'.$post->image) }}" 
                            class="img-fluid" alt="Featured Image"
                            style="width: 100%"
                        >
                    </div>
                    <hr>
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

            <div class="card">
                <div class="header bg-indigo">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->categories as $category)
                        <span class="label bg-indigo">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            
            <div class="card">
                <div class="header bg-teal">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->tags as $tag)
                        <span class="label bg-teal">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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