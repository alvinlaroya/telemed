<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WyswygController extends Controller
{

    /**
     * Wyswyg editor upload media files.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function upload(Request $request)
    {
        $user = auth()->user();
        if($request->has('upload')){
            $file = $request->file('upload');
            $uploadedFile = $user->addMedia($file)->toMediaCollection('wyswyg');
            if($uploadedFile){
                return response()->json(array('url' => $uploadedFile->getFullUrl()), 200);
            }else{
                return response()->json(array('error' => array('message' => 'Something went wrong! Please try again.')), 200);
            }
        }
    }

}
