@extends('front._layout.layout')

@section('seo_title', 'Contact')

@section('head_scripts')
{!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection


@section('content')


<!-- Hero Section -->
<section style="background: url(/themes/front/img/hero.jpg); background-size: cover; background-position: center center" class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Have an interesting news or idea? Don't hesitate to contact us!</h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
       
        <main class="col-lg-8"> 
            <div class="container">
                @if(!empty($systemMessage))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$systemMessage}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @include('front.contact.partials.contact_form')   
            </div>
        </main>
        <aside class="col-lg-4">
            <!-- Widget [Contact Widget]-->
            <div class="widget categories">
                <header>
                    <h3 class="h6">Contact Info</h3>
                    <div class="item d-flex justify-content-between">
                        <span>15 Yemen Road, Yemen</span>
                        <span><i class="fa fa-map-marker"></i></span>
                    </div>
                    <div class="item d-flex justify-content-between">
                        <span>(020) 123 456 789</span>
                        <span><i class="fa fa-phone"></i></span>
                    </div>
                    <div class="item d-flex justify-content-between">
                        <span>info@company.com</span>
                        <span><i class="fa fa-envelope"></i></span>
                    </div>
                </header>

            </div>
            <div class="widget latest-posts">
                <header>
                    <h3 class="h6">Latest Posts</h3>
                </header>
                <div class="blog-posts"><a href="blog-post.html">
                    @foreach(App\Models\Blog::query() ->where('index_page',1)->orderBy('created_at','DESC')->limit(3)->get() as $blog)    
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="{{url('/themes/front/img/small-thumbnail-1.jpg')}}" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>{{$blog->name}}</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i> {{$blog->number_of_views}}</div>
                                    <div class="comments"><i class="icon-comment"></i>{{$blog->number_of_comments}}</div>
                                </div>
                            </div>
                        </div></a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection