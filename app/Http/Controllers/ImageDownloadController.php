<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageDownloadController extends Controller
{
   public function upload(Request $request, Model $model)
   {

       $this->validate($request, [
           'image' => 'required|image|mimes:jpeg',
           'name' => 'required'
       ]);

       $imageName = time(). '.' . $request->image->getClientOriginalExtension();

       $img = new Image();
       $img->image_name = $request->name;
       $img->image_path = $imageName;

       $model->images()->save($img);

       $request->image->move(public_path('images'), $imageName);

       return response('', 201);
   }
}
