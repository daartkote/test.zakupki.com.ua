<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Input;
use Validator;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = Input::file('image');
        $name = Input::get('name');
        $modelId = Input::get('modelId');
        $type = Input::get('type');

        $inputs = [
            'image' => $file,
            'name' => $name,
            'modelId' => $modelId,
            'type' => $type,
        ];

        $rules = [
            'image' => 'mimes:jpeg,jpg|required',
            'name' => 'required|min:1',
            'modelId' => 'required|min:1',
            'type' => 'required|min:1|max:2',
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        $image = Image::create([
            'name' => $name,
            'file_name' => time() . '-' . $file->getClientOriginalName(),
            'model_id' => $modelId,
            'type' => $type,
        ]);

        $file->move($image->getUploadDir(), $image->file_name);

        return response()->json([
            'path'=> $image->getPath(),
            'name' => $image->name
        ], 200);
    }
}
