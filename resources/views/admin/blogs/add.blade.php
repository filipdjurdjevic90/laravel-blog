@extends('admin._layout.layout')

@section('seo_title', __('Add new Blog'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Add new blog')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">@lang('Home')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.blogs.index')}}">@lang('Blogs')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Add new blog')
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Enter data for the blog')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form"
                        action="{{route('admin.blogs.insert')}}"
                        method="post"
                        enctype="multipart/form-data"
                        role="form"
                        >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                     <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input 
                                            name="name"
                                            value="{{old('name')}}"
                                            type="text" 
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="Enter name"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'name'])
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('Blog Category')</label>
                                        <select 
                                            name="blog_category_id" 
                                            class="form-control @if($errors->has('blog_category_id')) is-invalid @endif"
                                            >
                                            <option value="">--@lang('Choose Category')  --</option>
                                            @foreach($blogCategories as $blogCategory)
                                            <option 
                                                value="{{$blogCategory->id}}"
                                                @if($blogCategory->id == old('blog_category_id'))
                                                selected
                                                @endif
                                                >{{$blogCategory->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'blog_category_id'])
                                    </div> 
                                    
                                       <div class="form-group select2-purple">
                                        <label>@lang('Tags') </label>
                                        <select 
                                            name="tag_id[]"
                                            class="form-control @if($errors->has('tag_id')) is-invalid @endif" 
                                            multiple
                                            >
                                            @foreach($tags as $tag)
                                            <option 
                                                value="{{$tag->id}}"
                                                @if(
                                                is_array(old('tag_id'))
                                                && in_array($tag->id, old('tag_id'))
                                                )
                                                selected
                                                @endif
                                                >{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'tag_id'])
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>@lang('Blog Text')</label>
                                        <textarea 
                                            name="blog_text"
                                            class="form-control @if($errors->has('blog_text')) is-invalid @endif" 
                                            placeholder="Enter Blog Text"
                                            >{{old('blog_text')}}</textarea>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'blog_text'])
                                    </div>

                                   

                                    <div class="form-group">
                                        <label>@lang('On Index Page') </label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="on-index-page-no" 
                                                name="index_page"
                                                value="0"
                                                @if(0 == old('index_page'))
                                                checked
                                                @endif
                                                class="custom-control-input"
                                                >
                                                <label class="custom-control-label" for="on-index-page-no">No</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="on-index-page-yes" 
                                                name="index_page"
                                                value="1"
                                                @if(1 == old('index_page'))
                                                checked
                                                @endif
                                                class="custom-control-input"
                                                >
                                                <label class="custom-control-label" for="on-index-page-yes">Yes</label>
                                        </div>
                                        <!-- TRIK ZA IZMESTANJE GRESAKA SA BACKEND-a NA BILO KOJU POZICIJU -->
                                        <div style="display:none;" class="form-control @if($errors->has('index_page')) is-invalid @endif"></div>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'index_page'])
                                    </div>

                                 

                                    <div class="form-group">
                                        <label>@lang('Choose New Photo')  </label>
                                        <input 
                                            name="photo" 
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                    </div>
                                    
                                 
                                </div>
                                <div class="offset-md-1 col-md-5">

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> @lang('Save')</button>
                            <a href="{{route('admin.blogs.index')}}" class="btn btn-outline-secondary"> @lang('Cancel')</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('footer_javascript')
<script type="text/javascript">

   
    $('#entity-form [name="blog_category_id"]').select2({
        "theme": "bootstrap4"
    });

    $('#entity-form [name="tag_id[]"]').select2({
        "theme": "bootstrap4"
    });

    $('#entity-form').validate({
        rules: {
          
            "blog_category_id": {
                "required": true
            },
            "name": {
                "required": true,
                "maxlength": 255
            },
            "blog_text": {
                "maxlength": 2000
            },
            
            "index_page": {
                "required": true
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

</script>
@endpush