@extends('front._layout.layout')

@section('seo_title', _('Home'))

@section('content')
<!-- Hero Section-->
@include('front.index.index_slider')
<!-- Intro Section-->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="h3">@lang('Some great intro here')</h2>
                <p class="text-big">@lang('Place a nice ')<strong>@lang('introduction')</strong>@lang(' here ')  <strong>@lang('to catch readers attention ')</strong>.</p>
            </div>
        </div>
    </div>
</section>
<section class="featured-posts no-padding-top">
    <div class="container">
        
       
         @foreach($blogs as $key => $blog)
           
         @if(($key % 2) == 0)
       <!-- Post-->
        <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
                <div class="text-inner d-flex align-items-center">
                    <div class="content">
                        <header class="post-header">
                            <div class="category"><a href="blog-category.html">{{optional($blog->blogCategory)->name}}</a></div><a href="{{route('front.blogs.blog_post',['blog'=>$blog->id])}}">
                                <h2 class="h4">{{$blog->name}}</h2></a>
                        </header>
                        <p>{{$blog->blog_text}}</p>
                        <footer class="post-footer d-flex align-items-center"><a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{url('/themes/front/img/avatar-1.jpg')}}" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{optional($blog->user)->name}}</span></div></a>
                            <div class="date"><i class="icon-clock"></i> {{$blog->created_at->diffForHumans()}}</div>
                            <div class="comments"><i class="icon-comment"></i>{{$blog->number_of_comments}}</div>
                        </footer>
                    </div>
                </div>
            </div>
            <div class="image col-lg-5"><img src="{{url('/themes/front/img/featured-pic-1.jpeg')}}" alt="..."></div>
        </div>
     @else(($key % 2) !== 0)
         <div class="row d-flex align-items-stretch">
          <div class="image col-lg-5"><img src="{{url('/themes/front/img/featured-pic-2.jpeg')}}" alt="..."></div>
          <div class="text col-lg-7">
            <div class="text-inner d-flex align-items-center">
              <div class="content">
                <header class="post-header">
                  <div class="category"><a href="blog-category.html">{{optional($blog->blogCategory)->name}}</a></div><a href="blog-post.html">
                    <h2 class="h4">{{$blog->name}}</h2></a>
                </header>
                <p>{{$blog->blog_text}}</p>
                <footer class="post-footer d-flex align-items-center"><a href="blog-author.html" class="author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="{{url('/themes/front/img/avatar-1.jpg')}}" alt="..." class="img-fluid"></div>
                    <div class="title">{{optional($blog->user)->name}}<span></span></div></a>
                  <div class="date"><i class="icon-clock"></i>{{$blog->created_at->diffForHumans()}}</div>
                  <div class="comments"><i class="icon-comment"></i>{{$blog->number_of_comments}}</div>
                </footer>
              </div>
            </div>
          </div>
        </div>
         @endif
        
        @endforeach
              

    </div>
</section>
<!-- Divider Section-->
<section style="background: url(/themes/front/img/divider-bg.jpg); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>{{$quote}}</h2>
                <a href="contact.html" class="hero-link">@lang('Contact Us')</a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Posts -->
<section class="latest-posts"> 
    <div class="container">
        <header> 
            <h2>@lang('Latest from the blog')</h2>
            <p class="text-big">@lang('Lorem ipsum dolor sit amet, consectetur adipisicing elit.')</p>
        </header>
        <div class="owl-carousel" id="latest-posts-slider" >
          
        
          <div class="row">
               @foreach($blogs as $blog)
                 @include('front.index.index_slider_lastest_posts',[
                     'blogs'=>$blog
                 ])
               @endforeach
          
          </div>
           
        </div>
    </div>
</section>



<!-- Gallery Section-->
<section class="gallery no-padding">    
    <div class="row">
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-1.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-1.jpg')}}" alt="gallery image alt 1" class="img-fluid" title="gallery image title 1">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-2.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-2.jpg')}}" alt="gallery image alt 2" class="img-fluid" title="gallery image title 2">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-3.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-3.jpg')}}" alt="gallery image alt 3" class="img-fluid" title="gallery image title 3">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-4.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-4.jpg')}}" alt="gallery image alt 4" class="img-fluid" title="gallery image title 4">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection