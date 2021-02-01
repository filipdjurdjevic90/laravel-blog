<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Validation\Rule;

class BlogCategoriesController extends Controller
{
     public function index(Request $request){
        
        $blogCategories= BlogCategory::query()
                ->orderBy('priority')
                ->get();
       return view ('admin.blog_categories.index',[
           'blogCategories'=>$blogCategories,
       ]);
    }
    public function add(Request $request){
        return view ('admin.blog_categories.add',[
            
        ]);
    }
    public function insert(Request $request){
        $formData = $request->validate([
            'name'=>['required', 'string', 'min:2', 'unique:blog_categories,name'],
            'description'=>['nullable', 'string','min:10', 'max:255'],
        ]);
        
        $newBlogCategory= new BlogCategory();
        
        $newBlogCategory->fill($formData);
        
        $blogCategoryWithHighestPriority= BlogCategory::query()
                ->orderBy('priority', 'desc')
                ->first();
        
        
        if($blogCategoryWithHighestPriority){
            $newBlogCategory->priority = $blogCategoryWithHighestPriority->priority +1 ;
        }else{
            $newBlogCategory->priority = 1;
        }
        
        $newBlogCategory->save();
        
        
        session()->flash('system_message',__('Blog category has been added'));
        
        return redirect()->route('admin.blog_categories.index');

        }
    public function edit(Request $request, BlogCategory $blogCategory){
        
        return view ('admin.blog_categories.edit',[
            'blogCategory'=>$blogCategory,
        ]);
    }
    public function update(Request $request, BlogCategory $blogCategory){
        
         $formData = $request->validate([
            'name' => ['required', 'string', Rule::unique('blog_categories')->ignore($blogCategory->id)],
        ]);
         
        $blogCategory->fill($formData);
        $blogCategory->save();

        session()->flash('system_message', __('Blog Category has been saved!'));

        return redirect()->route('admin.blog_categories.index');
    }
    public function delete(Request $request){
        $formData = $request->validate([
            'id'=>['required', 'numeric','exists:blog_categories,id'],
        ]);
        
        $blogCategory= BlogCategory::findOrFail($formData['id']);
        
          $blogCategory->delete();
         
          BlogCategory::query()
                  ->where('priority','>', $blogCategory->priority)
                  ->decrement('priority');
         
        session()->flash('system_message',__('Blog category has been deleted'));
        
        return redirect()->route('admin.blog_categories.index');        
    }
    public function changePriorities(Request $request){
        $formData = $request->validate([
            'priorities'=>['required','string'],
        ]);
        
        $priorities = explode(',', $formData['priorities']);
       
        foreach ($priorities as $key => $id){
            
         $blogCategory= BlogCategory::findOrFail($id);
         
         $blogCategory->priority = $key + 1;
         
         $blogCategory->save();
         
        }
        
        session()->flash('system_message',__('Blog categories have been reordered'));
        
        return redirect()->route('admin.blog_categories.index');  
        
    }
}
