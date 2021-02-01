@extends('front._layout.layout')

@section('seo_title', 'Author')


@section('content')
<div class="container">
    <div class="row">
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <h2 class="mb-3 author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="/themes/front/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                    <div class="title">
                        <span>Posts by author "{{$blog->user->name}}"</span>
                    </div>
                </h2>
                <div class="row">
                    <!-- post -->
                    @foreach($blogsPost as $blog)
                    
                     <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="{{route('front.blogs.blog_post',['blog'=>$blog->id])}}"><img src="{{$blog->getPhotoUrl()}}" alt="..." class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{$blog->created_at->toFormattedDateString()}}</div>
                                <div class="category"><a href="{{route('front.blogs.blog_category',['blog'=>$blog->blogCategory->id])}}">{{optional($blog->blogCategory)->name}}</a></div>
                            </div><a href="{{route('front.blogs.blog_post',['blog'=>$blog->id])}}">
                                <h3 class="h4">{{$blog->name}}</h3></a>
                            <p class="text-muted">{{$blog->blog_text}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="{{route('front.blogs.blog_autor',['blog'=>$blog->user->id])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="{{optional($blog->user)->getPhotoUrl()}}" alt="..." class="img-fluid"></div>                            
                                    <footer class="post-footer d-flex align-items-center"><a href="{{route('front.blogs.blog_autor',['blog'=>$blog->user->id])}}" class="author d-flex align-items-center flex-wrap">

                                    <div class="title"><span>{{optional($blog->user)->name}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i>{{$blog->created_at->diffForHumans()}}</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>{{$blog->number_of_comments}}</div>
                            </footer>
                        </div>
                    </div>
                                        @endforeach
                                        </div>
                                        <!-- Pagination -->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-template d-flex justify-content-center">
                                                {{$blogsPaginate->links()}}
                                            </ul>
                                        </nav>
                                        </div>
                                        </main>




                                        @include('front.blogs.partials.aside')
                                        </div>
                                        </div>
                                        @endsection