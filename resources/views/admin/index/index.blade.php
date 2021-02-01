@extends('admin._layout.layout')

@section('seo_title',__('Starter'))

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('Card title')</h5>

                        <p class="card-text">
                            @lang('Some quick example text to build on the card title and make up the bulk of the cards
                            content.')
                        </p> 

                        <a href="#" class="card-link">@lang('Card link')</a>
                        <a href="#" class="card-link">@lang('Another link')</a>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">@lang('Card title')</h5>

                        <p class="card-text">
                           @lang(' Some quick example text to build on the card title and make up the bulk of the cards
                            content.')
                        </p>
                        <a href="#" class="card-link">@lang('Card link')</a>
                        <a href="#" class="card-link">@lang('Another link')</a>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">@lang('Featured')</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">@lang('Special title treatment')</h6>

                        <p class="card-text">@lang('With supporting text below as a natural lead-in to additional content.')</p>
                        <a href="#" class="btn btn-primary">@lang('Go somewhere') </a>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0"> @lang('Featured')</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">@lang('Special title treatment')</h6>

                        <p class="card-text">@lang('With supporting text below as a natural lead-in to additional content.') </p>
                        <a href="#" class="btn btn-primary"> @lang('Go somewhere')</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@endsection