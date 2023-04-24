<?php 
namespace App\Services;

use App\Models\Image;

use Illuminate\Http\Request;

use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class ImageService{
    use HttpResponses;
Public  function getall(){
   $image =Image::all();
   return $this->success([
     'images'=>$image
   ]);
}

public function store(Request $request){
  
    $validator = Validator::make($request->all(),[
        'file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);
    if($validator->fails()){
        return $this->error([
           $validator->messages() 
        ],null,422);
    }else{
        $image = new Image();

        $image->name = $request->file('file')->getClientOriginalName();
        $image->path = $request->file('file')->store('public/images');

        $image->save();
        $request->file('file')->move(public_path('images'), $image->name);

        return $this->success([

        ],"Image Was Uploaded Successfully");
    }
}
}