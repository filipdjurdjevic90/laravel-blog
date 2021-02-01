<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="logo">
                <h6 class="text-white">Bootstrap Blog</h6>
            </div>
            <div class="contact-details">
                <p>53 Broadway, Broklyn, NY 11249</p>
                <p>Phone: (020) 123 456 789</p>
                <p>Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
                <ul class="social-menu">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="menus d-flex">
                <ul class="list-unstyled">
                    <li> <a href="{{route('front.index.index')}}">Home</a></li>
                    <li> <a href="{{route('front.blogs.index')}}">Blog</a></li>
                    <li> <a href="{{route('front.contact.index')}}">Contact</a></li>
                    <li> <a href="/login">Login</a></li>
                </ul>
                <ul class="list-unstyled">
           @foreach(App\Models\BlogCategory::query()->orderBy('name')->limit(4)->get() as $blogCategory)          
                <li> <a href="blog-category.html">{{$blogCategory->name}}</a></li>
                @endforeach  
              </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="latest-posts"><a href="blog-post.html">

                
                    
   @foreach(App\Models\Blog::query() ->where('index_page',1)->orderBy('created_at','DESC')->limit(3)->get() as $blog)
                <div class="post d-flex align-items-center">
                    <div class="image"><img src="{{url('/themes/front/img/small-thumbnail-1.jpg')}}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>{{$blog->name}}</strong><span class="date last-meta">{{$blog->created_at->toFormattedDateString()}}</span></div>
                </div></a><a href="{{route('front.blogs.blog_post',['blog'=>$blog->id])}}">
                    @endforeach


            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2017. All rights reserved. Your great site.</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>Template By <a href="https://bootstrapious.com/p/bootstrap-carousel" class="text-white">Bootstrapious</a>
                        <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                    </p>
                </div>
            </div>
        </div>
    </div>