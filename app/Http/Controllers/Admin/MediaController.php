<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MediaController extends Controller
{
   public function upload(Request $request){
       $this->validate($request,[
        'files.*' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:20648',
       ]);
       $data = [];
       $files = $request->allFiles();
       foreach($files['files'] as $file){

           $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
           $safeFilename = Str::slug($originalFilename);

           $filename = "store/".$safeFilename.'-'.uniqid().'.'.$file->guessExtension();
           $media = new Media();
           $media->image_path = $filename;
           $media->file_size = $file->getSize();
           $media->save();

           Storage::disk('public')->put($filename, file_get_contents($file));

          array_push($data, ['ref' => $media->id, 'url' => Storage::url($filename) ]) ;
       }

       return response()->json($data, 200);

    }

    public function remove($id){
       if(!$id){
           $media = Media::findOrFail($id);
           Storage::delete($media->image_path);
           $media->delete();
       }
       return response()->json([], 200);
    }
}
