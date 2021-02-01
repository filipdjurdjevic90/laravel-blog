@extends('admin._layout.layout')

@section('seo_title', __('Add new Index Slider'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Add new Index Slider')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">@lang('Home')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index_sliders.index')}}">@lang('Index Sliders')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Add new Index Slider')
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
                        <h3 class="card-title">@lang('Enter data for the Index Slider')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form" 
                        role="form" 
                        action="{{route('admin.index_sliders.insert')}}" 
                        method="post"
                        enctype="multipart/form-data"
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
                                        <label>@lang('Headline')</label>
                                        <input 
                                            name="headline"
                                            value="{{old('headline')}}"
                                            type="text"
                                            class="form-control @if($errors->has('headline')) is-invalid @endif"
                                            placeholder="Enter headline"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'headline'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Website')</label>
                                        <input 
                                            name="link"
                                            value="{{old('link')}}"
                                            type="url"
                                            class="form-control @if($errors->has('link')) is-invalid @endif"
                                            placeholder="Enter website url"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'link'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Choose New Photo')</label>
                                        <input 
                                            name="photo" 
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                        >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang('Save')</button>
                            <a href="{{route('admin.index_sliders.index')}}" class="btn btn-outline-secondary">@lang('Cancel')</a>
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
@endsection

@push('footer_javascript')
<script type="text/javascript">


    $('#entity-form').validate({
        rules: {
            "name": {
                required: true,
                maxlength: 25
            },
            "headline": {
                required: true,
                maxlength: 50
            },
            "link": {
                required: false,
                url: true
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