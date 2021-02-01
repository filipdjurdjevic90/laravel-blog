<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    
  
    protected $fillable = [
        'blog_category_id', 'name', 'blog-text', 'blog_tags_id', 'index_page', 'priority', 'user_id'
    ];
    
    
    //RELATIONSHIPS
    
    public function blogCategory()
    {
        return $this->belongsTo(
            BlogCategory::class,
            'blog_category_id', 
            'id' 
        );
    }
    
    
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'blog_tags',
            'blog_id',
            'tag_id'
        );
    }
    
     public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id', 
            'id' 
        );
    }
    
    
   
   
    /**
     * @return boolean
     */
    public function isOnIndexPage()
    {
        return $this->index_page == 1 ? true : false;
    }
    
    public function getPhotoUrl()
    {
		if ($this->photo) {
			return url('/storage/blogs/' . $this->photo1);
		}
		
        return url('/themes/front/img/blog-1.jpg');
    }
	
	public function getPhotoThumbUrl()
	{
		
		
		if ($this->photo) {
			return url('/storage/blogs/thumbs/' . $this->photo1);
		}
		
		return url('/themes/front/img/blog-1.jpg');
	}
	
	public function deletePhoto()
	{
		if (!$this->photo) {
			return $this; 
		}
		
		$photoFilePath = public_path('/storage/blogs/' . $this->photo);
		
		if (!is_file($photoFilePath)) {
		
			return $this;
		}
		
		unlink($photoFilePath);
		
		
		
		$photoThumbPath = public_path('/storage/blogs/thumbs/' . $this->photo);
		
		if (!is_file($photoThumbPath)) {
			
			return $this;
		}
		
		unlink($photoThumbPath);
		
		return $this;
	}
    
    public function getFrontUrl()
    {
        return route('front.blogs.blog_post', [
            'blog' => $this->id,
            'seoSlug' => \Str::slug($this->name),
        ]);
    }
}
