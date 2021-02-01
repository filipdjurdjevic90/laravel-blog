
<div class="post col-md-4">
    <div class="post-thumbnail"><a href="blog-post.html"><img src="{{url('/themes/front/img/featured-pic-2.jpeg')}}" alt="..." class="img-fluid"></a></div>
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="date">
                      {{$blog->created_at->toFormattedDateString()}}</div>
                  <div class="category"><a href="blog-category.html">{{$blog->blogCategory->name}}</a></div>
                </div><a href="blog-post.html">
                  <h3 class="h4">{{$blog->name}}</h3></a>
                <p class="text-muted">{{$blog->description}}</p>
              </div>
            </div>
