<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;



class MediaController extends Controller
{
   public function upload(Request $request){

       $path = $request->file('file')->store('product');

       $media = new Media();
       $media->title = $request->title;
       $media->image_path = '/'.$request->title.'/'.$path;
       $media->file_size = $request->file('file')->getSize();
       $media->save();

       $data = ['ref' => $media->id, 'url' => $media->image_path ];

       return response()->json($data, 200);

    }
}
