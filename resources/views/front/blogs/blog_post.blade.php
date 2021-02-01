@extends('front._layout.layout')

@section('seo_title', $blog->name )


@section('content')

<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8"> 
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="/themes/front/img/blog-post-3.jpeg" alt="..." class="img-fluid"></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="category"><a href="{{route('front.blogs.blog_category',['blog'=>$blog->blogCategory->id])}}">{{optional($blog->blogCategory)->name}}</a></div>
                        </div>
                        <h1>{{$blog->name}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="{{route('front.blogs.blog_autor',['blog'=>$blog->user->id])}}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="/themes/front/img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{optional($blog->blogAutor)->name}}</span></div></a>
                            <div class="d-flex align-items-center flex-wrap">       
                                <div class="date"><i class="icon-clock"></i>{{$blog->created_at->diffForHumans()}}</div>
                                <div class="views"><i class="icon-eye"></i>{{$blog->view}}</div>
                                <div class="comments meta-last"><a href="#post-comments"><i class="icon-comment"></i>12</a></div>
                            </div>
                        </div>
                        <div class="post-body">
                            <p class="lead">{{$blog->description}}</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p> <img src="/themes/front/img/featured-pic-3.jpeg" alt="..." class="img-fluid"></p>
                            <h3>Lorem Ipsum Dolor</h3>
                            <p>div Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda temporibus iusto voluptates deleniti similique rerum ducimus sint ex odio saepe. Sapiente quae pariatur ratione quis perspiciatis deleniti accusantium</p>
                            <blockquote class="blockquote">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                <footer class="blockquote-footer">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <p>quasi nam. Libero dicta eum recusandae, commodi, ad, autem at ea iusto numquam veritatis, officiis. Accusantium optio minus, voluptatem? Quia reprehenderit, veniam quibusdam provident, fugit iusto ullam voluptas neque soluta adipisci ad.</p>
                        </div>
                        <div class="post-tags">
                            @foreach($blog->tags as $tag)
                            <a href="blog-tag.html" class="tag">{{$tag->name}}</a>
                            @endforeach

                        </div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                                <div class="text"><strong class="text-primary">Previous Post </strong>
                                    <h6>I Bought a Wedding Dress.</h6>
                                </div></a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text"><strong class="text-primary">Next Post </strong>
                                    <h6>I Bought a Wedding Dress.</h6>
                                </div>
                                <div class="icon next"><i class="fa fa-angle-right">   </i></div></a></div>
                        <div id="comment">
                        <div class="post-comments" id="post_comments">
                            <header>
                                <h3 class="h6">Post Comments<span class="no-of-comments">()</span></h3>
                            </header>
                            
                            <div class="comment">
                                <div class="comment-header d-flex justify-content-between">
                                    <div class="user d-flex align-items-center">
                                        <div class="image"><img src="/themes/front/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="title"><strong></strong><span class="date"></span></div>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p></p>
                                </div>
                            </div>
                      
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">Leave a reply</h3>
                            </header>
                            
                        </div>
                              </div>
                    </div>
                </div>
            </div>
        </main>
        @include('front.blogs.partials.aside')

    </div>
</div>

@endsection



    
