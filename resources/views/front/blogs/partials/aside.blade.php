<aside class="col-lg-4">
          <!-- Widget [Search Bar Widget]-->
          <div class="widget search">
            <header>
              <h3 class="h6">@lang('Search the blog')</h3>
            </header>
            <form action="blog-search.html" class="search-form">
              <div class="form-group">
                <input type="search" placeholder="What are you looking for?">
                <button type="submit" class="submit"><i class="icon-search"></i></button>
              </div>
            </form>
          </div>
          <!-- Widget [Latest Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">@lang('Latest Posts')</h3>
            </header>
            <div class="blog-posts">
                @foreach(App\Models\Blog::query() ->where('index_page',1)->orderBy('created_at','DESC')->limit(3)->get() as $blog)
                <a href="{{route('front.blogs.blog_post',['blog'=>$blog->id])}}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{url('/themes/front/img/featured-pic-2.jpeg')}}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>{{$blog->blogCategory->name}}</strong>
                    <div class="d-flex align-items-center">
                      <div class="views"><i class="icon-eye"></i>{{$blog->number_of_views}}</div>
                      <div class="comments"><i class="icon-comment"></i>{{$blog->number_of_coments}}</div>
                    </div>
                  </div>
                </div></a>
                @endforeach
            </div>
          </div>
          <!-- Widget [Categories Widget]-->
          <div class="widget categories">
            <header>
              <h3 class="h6">@lang('Categories')</h3>
            </header>
              @foreach(App\Models\BlogCategory::query()->orderBy('name')->withCount(['blogs'])->limit(8)->get() as $blogCategory)
            <div class="item d-flex justify-content-between"><a href="{{route('front.blogs.blog_category',['blog'=>$blog->blogCategory->id])}}">{{$blogCategory->name}}</a><span>{{$blogCategory->blogs_count}}</span></div>
            @endforeach
           
          </div>
          <!-- Widget [Tags Cloud Widget]-->
          <div class="widget tags">       
            <header>
              <h3 class="h6">@lang('Tags')</h3>
            </header>
            <ul class="list-inline">
                @foreach(App\Models\Tag::query()->orderBy('name')->limit(4)->get() as $tag)
                <li class="list-inline-item"><a href="#" class="tag">{{$tag->name}}</a></li>
              @endforeach
           
            </ul>
          </div>
        </aside>