<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexSlider extends Model
{

  protected $table = 'index_sliders';
  
     protected $fillable =['name', 'headline', 'link', 'photo', 'priority'];
    
    
  
     public function getPhotoUrl() {
        
         if (!empty($this->photo)) {
            return url('/storage/index_sliders/' . $this->photo);
        }
        
        return url ('/themes/front/img/featured-pic-1.jpeg');
    }
    
    
    public function deletePhoto()
    {
        if (empty($this->photo)) {
            
            return $this;
        }
        
        $photoFilePath = public_path('/storage/index_sliders/' . $this->photo);
        
        if (!is_file($photoFilePath)) {
            
            return $this;
        }
        
        unlink($photoFilePath);
        
        return $this;
    }
}
