<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndexSlider;
use Illuminate\Validation\Rule;


class IndexSlidersController extends Controller
{
      public function index() {

     

        $indexSliders = IndexSlider::query()
                ->orderBy('priority')
                ->get();
        
        
        return view('admin.index_sliders.index', [
            'indexSliders' => $indexSliders,
          
        ]);
    }

    public function add(Request $request) {

        return view('admin.index_sliders.add', [
        ]);
    }

    public function insert(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'string', 'unique:index_sliders,name'],
            'headline' => ['required', 'string'],
            'link' => ['nullable', 'string', 'max:255','url'],
            'photo' => ['nullable', 'file', 'image','max:65000']
        ]);
      
        $newIndexSliders = new IndexSlider();

        $newIndexSliders->fill($formData);
           
        
         $indexSlidersWithHighestPriority=IndexSlider::query()
                ->orderBy('priority', 'desc')
                ->first();

        $newIndexSliders->save();
       
         if($indexSlidersWithHighestPriority){
            $newIndexSliders->priority = $indexSlidersWithHighestPriority->priority +1 ;
        }else{
            $newIndexSliders->priority = 1;
        }
        
        
        if($request->hasFile('photo')){
            
            $photoFile = $request->file('photo');
            
            $photoFileName = $newIndexSliders->id . '_' . $photoFile->getClientOriginalName();
            
             $photoFile->move(
                public_path('/storage/index_sliders/'),
                $photoFileName
            );
            
            $newIndexSliders->photo = $photoFileName;
            
            $newIndexSliders->save();

           
        }
        
        
        

        session()->flash('system_message', __('New Index Slider has been saved!'));

        return redirect()->route('admin.index_sliders.index');
    }

    public function edit(Request $request, IndexSlider $indexSlider) {

        return view('admin.index_sliders.edit', [
           'indexSlider' => $indexSlider
                
        ]);
       
    }

    public function update(Request $request, IndexSlider $indexSlider) {

        $formData = $request->validate([
            'name' => ['required', 'string', Rule::unique('index_sliders')->ignore($indexSlider->id)],
            'headline' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255','url'],
            'photo' => ['nullable', 'file', 'image','max:65000']
        ]);
             
        
        $indexSlider->fill($formData);
 
        $indexSlider->save();
        
         if ($request->hasFile('photo')) {
            
           
            $indexSlider->deletePhoto();
            
            $photoFile = $request->file('photo');
            
            $photoFileName = $indexSlider->id . '_' . $photoFile->getClientOriginalName();
            
            $photoFile->move(
                public_path('/storage/index_sliders/'),
                $photoFileName
            );
            
            $indexSlider->photo =  $photoFileName;
            $indexSlider->save();
            
           
            
        }

        session()->flash('system_message', __('IndexSlider has been saved!'));

        return redirect()->route('admin.index_sliders.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            
            'id' => ['required', 'numeric', 'exists:index_sliders,id'],
            
        ]);
        $formData['id'];
        
        $indexSlider = IndexSlider::findOrFail($formData['id']);
        
       
        $indexSlider->delete();
        
        $indexSlider->deletePhoto();
        
        session()->flash('system_message', __('IndexSlider has been deleted!'));
        
        return redirect()->route('admin.index_sliders.index');
    }
    
   public function deletePhoto(IndexSlider $indexSlider)
    {
        $indexSlider->deletePhoto(); 
        $indexSlider->photo = null;
        $indexSlider->save(); 
        
        return response()->json([ 
            
            "system_message" => __('Photo has been deleted'),
            "photo_url" => $indexSlider->getPhotoUrl(),
            
        ]);
    }


    public function changePriorities(Request $request){
        $formData = $request->validate([
            'priorities'=>['required','string'],
        ]);
        
        $priorities = explode(',', $formData['priorities']);
       
        foreach ($priorities as $key => $id){
            
         $indexSliders= IndexSlider::findOrFail($id);
         
         $indexSliders->priority = $key + 1;
         
         $indexSliders->save();
         
        }
        
        session()->flash('system_message',__('IndexSlider have been reordered'));
        
        return redirect()->route('admin.index_sliders.index');  
        
    }
}
