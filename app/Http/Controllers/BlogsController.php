<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\IndexSlider;
use App\Models\Tag;
use App\Models\BlogCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;

class BlogsController extends Controller {

    public function blogIndex() {

        $blogs = Blog::query()
                ->where('index_page', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);



        $blogCategories = BlogCategory::query()
                ->orderBy('name')
                ->withCount(['blogs'])
                ->get();


        $tags = Tag::query()
                ->orderBy('name')
                ->get();


        $users = User::query()
                ->orderBy('name')
                ->get();

        $indexSliders = IndexSlider::query()
                ->orderBy('priority')
                ->limit(3)
                ->get();

        $blogsPaginate = Blog::query()
                ->orderBy('created_at', 'DESC')
                ->paginate(12);


        $quote = Inspiring::quote();

        return view('front.blogs.index', [
            'blogs' => $blogs,
            'blogsPaginate' => $blogsPaginate,
        ]);
    }

    public function single(Blog $blog) {

        $blogsPost = Blog::query()
                ->where('blog_category_id', '=', $blog->blog_category_id)
                ->where('user_id', '=', $blog->user_id)
                ->take(4)
                ->latest()
                ->get();

        return view('front.blogs.blog_post', [
            'blog' => $blog,
            'blogsPost' => $blogsPost,
        ]);
    }

    public function blogCatgory(Blog $blog) {

        $blogsPost = Blog::query()
                ->where('blog_category_id', '=', $blog->blog_category_id)
                ->orderBy('created_at', 'DESC')
                ->get();
        
         $blogsPaginate = Blog::query()
                ->orderBy('created_at', 'DESC')
                ->paginate(12);

        return view('front.blogs.blog_category', [
            'blog' => $blog,
            'blogsPost' => $blogsPost,
            'blogsPaginate' => $blogsPaginate,
        ]);
    }

    public function blogAutor(Blog $blog) {
        
        $blogsPost = Blog::query()
                ->where('user_id', '=', $blog->user_id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        
        $blogsPaginate = Blog::query()
                ->orderBy('created_at', 'DESC')
                ->paginate(12);

        return view('front.blogs.blog_author', [
            'blog' => $blog,
            'blogsPost' => $blogsPost,
            'blogsPaginate' => $blogsPaginate,
        ]);
    }

    public function blogTag(Blog $blog) {
        
         $blogsPost = Blog::query()
                ->where('user_id', '=', $blog->user_id)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        
        $blogsPaginate = Blog::query()
                ->orderBy('created_at', 'DESC')
                ->paginate(12);


        return view('front.blogs.blog_tag', [
             'blog' => $blog,
            'blogsPost' => $blogsPost,
            'blogsPaginate' => $blogsPaginate,
        ]);
    }

}
