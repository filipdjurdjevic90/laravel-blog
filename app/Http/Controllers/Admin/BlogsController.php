<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;

class BlogsController extends Controller {

    public function index() {
        return view('admin.blogs.index', [
        ]);
    }

    public function datatable(Request $request) {

        $searchFilters = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'blog_category_id' => ['nullable', 'numeric', 'exists:blog_categories,id'],
            'index_page' => ['nullable', 'in:0,1'],
            'tag_id' => ['nullable', 'array', 'exists:tags,id'],
        ]);

         
        

        $query = Blog::query()
                ->with(['blogCategory', 'tags'])
               ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
                ->select(['blogs.*','blog_categories.name AS blog_category_name']);


     
        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('tags', function ($blog) {
                    return optional($blog->tags->pluck('name'))->join(', ');
                })
               
                ->addColumn('actions', function ($blog) {
                    return view('admin.blogs.partials.actions', ['blog' => $blog]);
                })
                ->editColumn('photo', function ($blog) {
                    return view('admin.blogs.partials.blog_photo', ['blog' => $blog]);
                })
                ->editColumn('id', function ($blog) {
                    return '#' . $blog->id;
                })
                ->editColumn('name', function ($blog) {
                    return '<strong>' . e($blog->name) . '</strong>';
                })
                ->editColumn('blog_text', function ($blog) {
                    return \Str::limit($blog->blog_text, 20) ;
                });
              
               
                


        $dataTable->rawColumns(['name', 'photo', 'actions']);

        $dataTable->filter(function ($query) use ($request, $searchFilters) {

            if (
                    $request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])
            ) {
                $searchTerm = $request->get('search')['value'];

                $query->where(function ($query) use ($searchTerm) {

                    $query->orWhere('blogs.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blogs.description', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blog_categories.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('blogs.id', '=', $searchTerm);
                });
            }



            if (isset($searchFilters['name'])) {
                $query->where('blogs.name', 'LIKE', '%' . $searchFilters['name'] . '%');
            }


            if (isset($searchFilters['blog_category_id'])) {
                $query->where('blogs.blog_category_id', '=', $searchFilters['blog_category_id']);
            }

            if (isset($searchFilters['index_page'])) {
                $query->where('blogs.index_page', '=', $searchFilters['index_page']);
            }

            if (isset($searchFilters['tag_ids'])) {
                $query->whereHas('tags', function ($subQuery) use ($searchFilters) {

                    $subQuery->whereIn('tag_id', $searchFilters['tag_ids']);
                });
            }
        });

        return $dataTable->make(true); 	
    }

    public function add(Request $request) {

        $blogCategories = BlogCategory::query()
                ->orderBy('priority')
                ->get();

        $tags = Tag::all();

        return view('admin.blogs.add', [
            'blogCategories' => $blogCategories,
            'tags' => $tags,
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
          
            'blog_category_id' => ['required', 'numeric', 'exists:blog_categories,id'],
            'name' => ['required', 'string', 'max:255', 'unique:blogs,name'],
            'blog_text' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'priority' => ['required', 'numeric'],
            'tag_id' => ['required', 'array', 'exists:tags,id', 'min:2'],
            'user_id' => ['required', 'array', 'exists:users,id', 'min:2'],
            'photo' => ['nullable', 'file', 'image'],
            'number_of_views' => ['nullable', 'numeric'],
            'number_of_comments' => ['nullable', 'numeric'],
        ]);

        

        $newBlog = new Blog();

        $newBlog->fill($formData);


        $newBlog->save();


        $newBlog->tags()->sync($formData['tag_id']);


        $this->handlePhotoUpload('photo', $request, $newBlog);
        



        session()->flash('system_message', __('New blog has been saved!'));

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Request $request, Blog $blog) {
        $blogCategories = BlogCategory::query()
                ->orderBy('priority')
                ->get();

        $tags = Tag::all();

        return view('admin.blogs.edit', [
            'blog' => $blog,
            'blogCategories' => $blogCategories,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, Blog $blog) {

        $formData = $request->validate([
            
            'blog_category_id' => ['required', 'numeric', 'exists:blog_categories,id'],
            'name' => ['required', 'string', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'blog_text' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'priority' => ['required', 'numeric'],
            'tag_id' => ['required', 'array', 'exists:tags,id', 'min:2'],
            'user_id' => ['required', 'array', 'exists:users,id', 'min:2'],
            'photo' => ['nullable', 'file', 'image'],
            'number_of_views' => ['nullable', 'numeric'],
            'number_of_comments' => ['nullable', 'numeric'],
            
        ]);

        $blog->fill($formData);

        $blog->save();
        $blog->tags()->sync($formData['tag_id']);


        $this->handlePhotoUpload('photo', $request, $blog);
       


        session()->flash('system_message', __('Blog has been saved'));

        return redirect()->route('admin.blogs.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:blogs,id'],
        ]);

        $formData['id'];

        $blog = Blog::findOrFail($formData['id']);

       
        $blog->delete();

        
        \DB::table('blog_tags')
                ->where('blog_id', '=', $blog->id)
                ->delete();

       
        $blog->deletePhoto();

        return response()->json([
                    'system_message' => __('Blog has been deleted')
        ]);
    }

    public function deletePhoto(Request $request, Blog $blog) {
        $formData = $request->validate([
            'photo' => ['required', 'string', 'in:photo'],
        ]);

        $photoFieldName = $formData['photo']; 

        $blog->deletePhoto($photoFieldName);


        $blog->$photoFieldName = null;
        $blog->save();

        return response()->json([
                    'system_message' => __('Photo has been deleted'),
                    'photo_url' => $blog->getPhotoUrl($photoFieldName),
        ]);
    }

    protected function handlePhotoUpload(
            string $photoFieldName, Request $request, Blog $blog
    ) {
        if ($request->hasFile($photoFieldName)) {


            $blog->deletePhoto($photoFieldName);

            $photoFile = $request->file($photoFieldName);

            $newPhotoFileName = $blog->id . '_' . $photoFieldName . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(
                    public_path('/storage/blogs/'), $newPhotoFileName
            );


            $blog->$photoFieldName = $newPhotoFileName;

            $blog->save();

          
            \Image::make(public_path('/storage/blogs/' . $blog->$photoFieldName))
                    ->fit(600, 800)
                    ->save();

      
            \Image::make(public_path('/storage/blogs/' . $blog->$photoFieldName))
                    ->fit(300, 300)
                    ->save(public_path('/storage/blogs/thumbs/' . $blog->$photoFieldName));
        }
    }

}
