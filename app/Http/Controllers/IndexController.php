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

class IndexController extends Controller {

    public function index() {
        
         $blogs= Blog::query()
                ->orderBy('priority')
                ->limit(3)
                ->get();
         
         $indexSliders= IndexSlider::query()
                ->orderBy('priority')
                ->limit(3) 
                ->get();
      
       
          $quote = Inspiring::quote();     

        return view('front.index.index', [
            'blogs' => $blogs,
            'indexSliders' => $indexSliders,
            'quote' => $quote,
            
            
          
                
        ]);
    }
    
}
