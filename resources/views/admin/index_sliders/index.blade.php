@extends('admin._layout.layout')

@section('seo_title', __('Index Sliders'))

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Index Sliders')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Index Sliders')</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('All Index Sliders')</h3>
                        <div class="card-tools">
                            
                            <form style="display:none;"id="change-priority-form" class="btn-group" method="POST" action="{{route('admin.index_sliders.change_priorities')}}">
                                @csrf
                                <input type="hidden" name="priorities" value="">
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-check"></i>
                                    @lang('Save Order')  
                                </button>
                                <button type="button" data-action="hide-order" class="btn btn-outline-danger">
                                    <i class="fas fa-remove"></i>
                                    @lang('Cancel')  
                                </button>
                            </form>
                            <button data-action="show-order" class="btn btn-outline-secondary">
                                <i class="fas fa-sort"></i>
                                @lang('Change Order')          
                            </button>
                            
                            
                            <a href="{{route('admin.index_sliders.add')}}" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>
                                @lang('Add new Index Slider')
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <table class="table table-bordered" id="entities-list-table">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">@lang('Photo')</th>
                                    <th>@lang('Name')</th>
                                    <th >@lang('Headline')</th>
                                    <th >@lang('Website')</th>
                                    <th class="text-center">@lang('Created At')</th>
                                    <th class="text-center">@lang('Last Change')</th>
                                    <th class="text-center">@lang('Actions')</th>

                                </tr>
                            </thead>
                            <tbody id="sortable-list">
                                @foreach($indexSliders as $indexSlider)
                                <tr data-id="{{$indexSlider->id}}">
                                   <td>
                                        <span style="display:none;" class="btn btn-outline-secondary handle">
                                            <i class="fas fa-sort"></i>
                                        </span>
                                        {{$indexSlider->id}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{$indexSlider->getPhotoUrl()}}" style="max-width: 80px;">
                                    </td>
                                    <td>
                                        <strong>{{$indexSlider->name}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{$indexSlider->headline}}</strong>
                                    </td>
                                    <td>
                                        @if($indexSlider->link)
                                        <a href="{{$indexSlider->link}}">{{$indexSlider->link}}</a>
                                        @endif
                                    </td>

                                    <td class="text-center">{{$indexSlider->created_at}}</td>
                                    <td class="text-center">{{$indexSlider->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('admin.index_sliders.edit', ['indexSlider' => $indexSlider->id])}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-info" 
                                                    data-toggle="modal" 
                                                    data-target="#delete-modal"

                                                    data-action ="delete"
                                                    data-id="{{$indexSlider->id}}"
                                                    data-name="{{$indexSlider->name}}"

                                                    >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<form  action="{{route('admin.index_sliders.delete')}}" method="POST" class="modal fade" id="delete-modal">
    @csrf
    <input type="hidden" name="id" value=""  >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Index Slider</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete indexSlider?</p>
                <strong data-container="name"></strong>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>

@endsection

@push('footer_javascript')

@push('head_links')
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@push('footer_javascript')

<script src="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">

$('#entities-list-table').on('click', '[data-action="delete"]', function (e) {
  
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    
    $('#delete-modal [name="id"]').val(id);
    $('#delete-modal [data-container="name"]').html(name);
});

$('#sortable-list').sortable({
    "handle": ".handle",
    "update": function(event, ui) {
        
        let priorities = $('#sortable-list').sortable('toArray', {
            "attribute": "data-id"
        });
        
        console.log(priorities);
        
        $('#change-priority-form [name="priorities"]').val(priorities.join(','));
    }
});

$('[data-action="show-order"]').on('click', function (e) {
    
    $('[data-action="show-order"]').hide();
    
    $('#change-priority-form').show();
    
    $('#sortable-list .handle').show();
});

$('[data-action="hide-order"]').on('click', function (e) {
    
    $('[data-action="show-order"]').show();
    
    $('#change-priority-form').hide();
    
    $('#sortable-list .handle').hide();
    
    $('#sortable-list').sortable('cancel');
});

</script>
@endpush
